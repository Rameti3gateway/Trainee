<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Socialite;
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
    public function handlegoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        dd($user);
        // $user->token;
    }
}
