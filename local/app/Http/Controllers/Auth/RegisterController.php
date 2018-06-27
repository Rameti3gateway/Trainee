<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/regiss';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'id_card'=> 'required|numeric|digits:13|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $ext = pathinfo(basename($_FILES['image']['name']) ,PATHINFO_EXTENSION);
        // random new name
        $new_image_name = 'img_'.uniqid().".".$ext;
        // $image_path = "../profile-image/" ;
        $image_public_path = "../public/img/profile-image/";
        // $upload_path = $image_path.$new_image_name;
        $upload_public_path = $image_public_path.$new_image_name;
        // $success = move_uploaded_file($_FILES['image']['tmp_name'],$upload_path);
        $public_success = move_uploaded_file($_FILES['image']['tmp_name'],$upload_public_path);
        if($public_success==FALSE){
            // echo $upload_path;
            echo $upload_public_path;
            exit();
        }
        $pro_image = $new_image_name;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'birt_date' => date($data['birt_date']),
            'university' => $data['university'],
            'major' => $data['major'],
            'password' => bcrypt($data['password']),
            'image' => $data['image'],
            'role'=>'user',
            'type' => 'general',
            'faculty'=>$data['faculty'],
            'id_card'=>$data['id_card'],
        ]);
    }
}
