<?php

namespace Modules\Admin\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;

class AdminLoginController extends Controller
{
    // protected $redirectTo = '/home';
      public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function showLoginForm()
    {
        if(!Auth::check()){
            return view('admin::auth.admin-login');
        }else{
            return redirect('/home');
        }
        
    }
     public function login(Request $request)
    {
        
        // $this->validate($request,[
        //     'email'=>'required|email',
        //     'password'=>'required|min:6',

        // ]);



        if (Auth::guard('admin')->attempt(['email'=>$request->email ,'password'=>$request->password],$request->remember)) {

            return redirect()->intended(route('admin'));
         
            
            // return route('admin',['id' => Auth::user()->id]);
        }
        return redirect()->back()->withInput($request->only('email','remember'));
        

    }
    
}
