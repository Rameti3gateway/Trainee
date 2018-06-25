<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('site::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('site::create');
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
    public function show($id)
    {
        // echo "Testt" or die;
         $blog = User::findOrFail($id);
          return View('site::blog.show')
                ->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        //  echo '555555555';
            if(User::where(''))
            $profile = User::find($id);
            return view('site::blog.edit')->with('profile',$profile);
    }
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    { 
        // echo "Testt" or die;        
        $profile = User::find($id);
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
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
