<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class SocialController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $login_usear = User::where('provider_id',$user->getId())->first();

        if($login_usear){
           
            auth()->login($user);

            return redirect()->to('/home');

        }

        else{
           
 

            $user = User::create([

                'name'     => $user->getNickname(),

                'email'    => $user->getEmail(),

                'provider' => 'gitHub',

                'provider_id' => $user->getId(),

            ]);

            return $user;

           // auth()->login($user->id);

           // return redirect()->to('/home');

        }
    
       
    }

  /* function createUser($getInfo,$provider){



        $user = User::where('github_id', $getInfo->id)->first();

        if (!$user) {

             $user = User::create([

                'name'     => $getInfo->name,

                'email'    => $getInfo->email,

                'provider' => $provider,

                'github_id' => $getInfo->id

            ]);

        }


        return $user;

    }    
    */
}
