<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    //============= ADD CONTACT ARE HERE ==============

    function Contact(){

        return view('frontend.contact');
    }

    function PostContact(Request $request){
       
       
            $request->validate([
   
               'name' => ['required'],
               'email' => ['required'],
               'subject' => ['required'],
               'message' => ['required'],
           ]);

           Contact::insert([

                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'crated_at' => Carbon::now(),

           ]);

         return $request->all();

        
     }




}
