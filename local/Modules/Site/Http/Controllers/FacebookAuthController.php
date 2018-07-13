<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Socialite;
use App\Services\SocialFacebookAccountService;
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
    public function handlefacebookCallback(SocialFacebookAccountService $service)
    {
        $user =  $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);       
        return redirect()->to('site/home');
     
        //  dd( $user);
    }
}
