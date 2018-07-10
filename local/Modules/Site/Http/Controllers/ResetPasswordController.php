<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
  
    public function index()
    { 
       return view('site::auth.passwords.email');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function reset($token)
    {
        return view('site::auth.passwords.reset',compact('token'));
    }

  
    
}
