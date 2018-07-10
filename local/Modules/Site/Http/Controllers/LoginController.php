<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatedUsers;


class LoginController extends Controller
{
   
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function index()
    {
        return view('site::auth.login');
    }

    
}
