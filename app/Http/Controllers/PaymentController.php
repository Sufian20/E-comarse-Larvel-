<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Cart;
use App\Mail\OrderShipped;
use App\Product;
use App\Sale;
use App\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PayPal\Exception\PPConnectionException;
use Srmklive\PayPal\Services\ExpressCheckout;

use Validator;
use URL;
use Session;
use Redirect;
use Input;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;



class PaymentController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        
       // parent::__construct();

        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    function FinalCheckout(Request $request){

        $total = $request->session()->get('total');
        $user_id = Auth::id();

        if(isset($request->payment)){

            $shipping_id = Shipping::insertGetId([
                'user_id' => $user_id,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'zipcode' => $request->zipcode,
                'massage' => $request->massage,
                'payment_type' => $request->payment,
                'created_at' =>Carbon::now()
            ]);

            $sale_id = Sale::insertGetId([
                'user_id' => $user_id,
                'shipping_id' =>$shipping_id,
                'grand_total' =>  $total,
                'created_at' =>Carbon::now()
            ]);

            $user_ip = $_SERVER['REMOTE_ADDR'];
            $carts = Cart::with('product')->where('user_ip', $user_ip)->get();

            foreach($carts as $item){
                Billing::insert([
                    'shipping_id' => $shipping_id,
                    'sale_id' =>  $sale_id,
                    'product_id' => $item->product_id,
                    'product_price' => $item->product->product_price,
                    'product_quantity' => $item->product_quantity,
                    'created_at' =>Carbon::now()
                ]);
        
                Product::findOrfail($item->product_id)->decrement('product_quantity', $item->product_quantity);
                 $item->product->id->decrement('product_quantity', $item->product_quantity);

                $item->delete();
        


                $item->delete();

           }



            if($request->payment == 'card'){

            $token = $request->stripeToken;
            \Stripe\Stripe::setApiKey("sk_test_51H30t6EgeRexmKh6ILYQehvA6ZNKUTZjfbRcBtgDzBxWPexKwT4eo5WeCHACnxHMpIAgZXZqmujcRGzpuTEwuRXx00sJK4kZbk");
            $charge = \Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "usd",
            "source" => $token, // obtained with Stripe.js
            "description" => "Payment For E-commerce"
            ], [
        
            ]);
            //Product Remove From Store After Payment
                 Shipping::findOrfail($shipping_id)->update([
                      'payment_status' => 2
                  ]);
           
                 $billings =  Billing::where('shipping_id', $shipping_id)->get();
        
                   Mail::to(Auth::user()->email)->send(new OrderShipped($billings));
                return "Thanks For Your Oder";       }
            elseif($request->payment == 'paypal'){
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();

                $item_1->setName('Item 1') /** item name **/
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice($total); /** unit price **/

                $item_list = new ItemList();
                $item_list->setItems(array($item_1));

                $amount = new Amount();
                $amount->setCurrency('USD')
                    ->setTotal($total);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Your transaction description');

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/
                    ->setCancelUrl(URL::route('status'));

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));
                    /** dd($payment->create($this->_api_context));exit; **/
                try {
                    $payment->create($this->_api_context);
                } catch (PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        \Session::put('error','Connection timeout');
                        return Redirect::route('Checkout');
                        /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                        /** $err_data = json_decode($ex->getData(), true); **/
                        /** exit; **/
                    } else {
                        \Session::put('error','Some error occur, sorry for inconvenient');
                        return Redirect::route('Checkout');
                        /** die('Some error occur, sorry for inconvenient'); **/
                    }
                }

                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

         /** add payment ID to session **/
               // Session::put('paypal_payment_id', $payment->getId());
                session(['paypal_payment_id' => $payment->getId()]);

                if(isset($redirect_url)) {
                    /** redirect to paypal **/
                    return Redirect::away($redirect_url);
                }

                \Session::put('error','Unknown error occurred');
                return Redirect::route('paywithpaypal');

                //return "Paypal";
            }          elseif($request->payment == 'cash'){
                return "Cash On Delivery";
            }
            elseif($request->payment == 'bank'){
                return "Bank Transfer";
            }
            else{
                return back()->with('PaymentSelect', 'You Changed Payment Method Value');
            }
        }
        else{
            return back()->with('PaymentSelect', 'Please Select Payment Method');
        }

    }

//    public function getPaymentStatus()
//    {
//        /** Get the payment ID before session clear **/
//        $payment_id = Session::get('paypal_payment_id');
//        /** clear the session payment ID **/
//        Session::forget('paypal_payment_id');
//        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
//            \Session::put('error','Payment failed');
//            return Redirect::route('Checkout');
//        }
//        $payment = Payment::get($payment_id, $this->_api_context);
//        /** PaymentExecution object includes information necessary **/
//        /** to execute a PayPal account payment. **/
//        /** The payer_id is added to the request query parameters **/
//        /** when the user is redirected from paypal back to your site **/
//        $execution = new PaymentExecution();
//        $execution->setPayerId(Input::get('PayerID'));
//        /**Execute the payment **/
//        $result = $payment->execute($execution, $this->_api_context);
//        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
//        if ($result->getState() == 'approved') { 
//            
//            /** it's all right **/
//            /** Here Write your database logic like that insert record or value in database if you want **/
//
//            \Session::put('success','Payment success');
//            return Redirect::route('Checkout');
//        }
//        \Session::put('error','Payment failed');
//
//		return Redirect::route('Checkout');
//    }
    public function cancel()

    {

        dd('Your payment is canceled. You can create cancel page here.');

    }


    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function success(Request $request)

    {
       $provider = $request->session()->get('provider');
       // $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);



        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            dd('Your payment was successfully. You can create success page here.');

        }



        dd('Something is wrong.');

    }
}
