<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class userCheck
{

    

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(!Auth::user()){

            redirect('/login');
        }

        else{
            if(Auth::user()->user_roll == 1){
                redirect('UserDashBoard');
            }
            else{
                redirect('AdminDashBoard');
            }
        }
        return $next($request);
    }
}
