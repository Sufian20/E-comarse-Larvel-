<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    //========= POST NEWSLETTER =========

    function Newsletter(Request $request){

        $request->validate([

            'email' => ['required'],

        ]);

        
  

           if(Newsletter::orderBy('email', 'asc') != ($request->eamil)){

                Newsletter::insert([
                    'email' => $request->email,
                    'created_at' => Carbon::now(),
                    
                ]);

                return back()->with('success', 'Thanks For Subscribe');
           }

          else{
            return redirect('newsletter')->with('error', 'Sorry! You have already subscribed ');
            
          }

           // 'email' => $request->email,
           // 'created_at' => Carbon::now(),

      


    }


}
