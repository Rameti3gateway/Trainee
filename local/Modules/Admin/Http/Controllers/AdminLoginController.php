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
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
