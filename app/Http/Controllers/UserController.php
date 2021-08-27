<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function ViewUsers(){

       $users =  User::orderBy('id', 'desc')->get();

        return view('backend.users.view_users', compact('users'));
    }

   public function MakeAdmin(Request $request, $id){

        User::findOrFail($id)->update([
            'utype' => 1,
        ]);

        return back();
    }

}
