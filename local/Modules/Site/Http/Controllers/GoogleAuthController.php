<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Socialite;
use App\Services\SocialGoogleAccountService;
class GoogleAuthController extends Controller
{
      //Auth google
     public function redirectTogoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handlegoogleCallback(SocialGoogleAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());
         auth()->login($user);    
        return redirect()->to('site/home');
        //dd($user);      
    }
}
