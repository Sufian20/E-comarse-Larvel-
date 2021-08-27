<?php

namespace App\Http\Controllers;

use App\Testmonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;

class TestmonialController extends Controller
{
    //============== ADD TESTMONIAL =============================

    public function AddTestMonial(){


        return view('backend.testmonial.add_testmonial');
    }

    public function PostTestMonial(Request $request){

        $request->validate([
            
        //  'clint_image' => ['required', 'image'],
            'clint_say' => ['required'],
            'clint_name' => ['required'],
            'clint_title' => ['required'],
            
        ]);

        if($request->hasFile('clint_image')){

           $image = $request->file('clint_image');

         $ext =    $request->clint_name .'-' .Str::lower(Str::random(3)) . '.' .$image->getClientOriginalExtension();

         Image::make($image)->resize(135, 105)->save(public_path('images_client/' .$ext));


         Testmonial::insert([
            'clint_name' => $request->clint_name,
            'clint_title' => $request->clint_say,
            'clint_say' => $request->clint_say,
            'clint_image' => $ext,
            'created_at' => Carbon::now(),

        
        ]);

        return $request->all();

        }

       

     

       
        return back()->with('success', 'Testmonial added successfully');
    }
}
