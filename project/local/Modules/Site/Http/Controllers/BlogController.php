<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class BlogController extends Controller
{

    public function index()
    {
        return view('site::index');
    }

    public function show($id)
    {
        // echo "Testt";
         $blog = User::findOrFail($id);
          return View('site::blog.show')
                ->with('blog', $blog);
    }

    public function edit($id)
    {
        //  echo '555555555';
            if(User::where(''))
            $profile = User::find($id);
            return view('site::blog.edit')->with('profile',$profile);      
                 
    }

    public function update(Request $request, $id)
    { 
        $profile = User::find($id);
        if($profile->id_card == $request->id_card){
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'id_card'=> 'required|numeric|digits:13|unique:users',
                'name' => 'required|string|max:255',
            ]);
        }
       
        if($validator->passes()){
            $image = $request->image;
            
            
            if($image != null){
                $oldimage = $profile->image;
                if($oldimage != "default.jpg"){
                    unlink("upload/img/site/profile-image/".$oldimage);                  
                }
               
                $photoName = 'user_'.uniqid().'_'.time().'.'.$image->getClientOriginalExtension();
                $image->move('upload/img/site/profile-image/', $photoName);
                $profile->image = $photoName;
            }
        
            $profile->name = $request->name;
            $profile->id_card = $request->id_card;
            $profile->gender = $request->gender;
            $profile->university = $request->university;
            $profile->major = $request->major;
            $profile->faculty = $request->faculty;
            $profile->birt_date = $request->birt_date;
        
            $profile->save();
            $id=Auth::user()->id;
            $url = "site/users/$id";           
            // return redirect('/site/users/{id}')->action('BlogController@show', ['id' => $id]);
            return redirect($url);
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
    }

 
    
}
