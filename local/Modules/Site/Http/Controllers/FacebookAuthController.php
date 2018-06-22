<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Socialite;
class FacebookAuthController extends Controller
{
      
    //Auth Facebook
     public function redirectTofacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handlefacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        return redirect()->To('/site');
        // $user->token;
    }
}
