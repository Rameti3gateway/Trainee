<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //Styles home 
        $acss = array('../assets/site/css/home/home.css');
        $this->data = array(
            'style' => $acss
        );       
        return view('site::login-after.home',$this->data);
    }
}
