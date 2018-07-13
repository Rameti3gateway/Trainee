<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
date_default_timezone_set("Asia/Bangkok");
class RegisterController extends Controller
{
  
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/site/home';


    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'id_card'=> 'required|numeric|digits:13|unique:users',
        ]);
    }

    protected function create(array $data)
    {
       
       if(array_key_exists('image', $data) == null){
            $photoName = "default.jpg";
           
       }else{
            $photoName = 'user_'.uniqid().'_'.time().'.'.$data['image']->getClientOriginalExtension();
            $data['image']->move('../assets/site/img/profile-image/user-image', $photoName);
            
       }
       return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'birt_date' => date($data['birt_date']),
            'university' => $data['university'],
            'major' => $data['major'],
            'password' => bcrypt($data['password']),
            'image' => $photoName,
            'role'=>'user',
            'type' => 'general',
            'faculty'=>$data['faculty'],
            'id_card'=>$data['id_card'],
        ]);
       
        
    }
}
