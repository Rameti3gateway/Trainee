<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
Use App\Times;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //Styles home        
        if(count(Times::where('user_id','=',Auth::user()->id)->get()) == 0){
            $data['check'] = true;
        }else{
            $data['check'] = false;
        }        
        return view('site::login-after.home',$data);
    }
}
