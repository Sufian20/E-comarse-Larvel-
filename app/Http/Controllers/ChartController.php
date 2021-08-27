<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    function UserChart(){

        $user_one =  User::whereDate('created_at', Carbon::now()->subDays(1));
        $user_two =  User::whereDate('created_at', Carbon::now()->subDays(2));
        $user_saven =  User::whereDate('created_at', Carbon::now()->subDays(7));
      
              return view('public.backend.js.chartjs.init.js',[
                  'user_one' => $user_one,
                  'user_two' => $user_two,
                  'user_saven' => $user_saven,
              ]);
         }
}
