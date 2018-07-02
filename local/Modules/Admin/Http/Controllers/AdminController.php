<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use App\Times;
use App\Tasks;
use Carbon\Carbon;
use App\Admin;
use Khill\Lavacharts\Lavacharts;
use Lava;
use Chart;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
        return view('admin::index');
    }
    public function dashboard(){
        $data['users'] = User::where('role','=','user')->get();
        
        return view('admin::dashboard',$data);
    }

    public function member(){
        $member = Admin::all();
        return view('admin::member',compact('member',$member));
    }
    
    public function showprofile($id,$userid){
        $data['blog'] = User::find($userid);
        $data['choosedate']= Times::select('date')->where('user_id','=',$userid)->where('time_checkin','!=',null)->groupBy('date')->orderBy('date','desc')->pluck('date','date');
        $data['choosedate']->prepend("choosedate");

        $queryweek = Times::select('date')->where('user_id','=',$userid)->groupBy('date')->get()->groupBy(function($date){return Carbon::parse($date->date)->format('W');});
        // $qw = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('W');});
        
        // $arr = [];
        // foreach ($qw as $key => $value) {
        //     $interval = $value[0]."=>".$value[count($value)-1];
        //     $arr["w".$key] = $interval;
        // }
        $qw = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('m');});
        foreach ($qw as $key => $value) {
            $month = Carbon::parse($value[0])->format('F');
            $arr["m".$key] = $month;
            
        }
        
        return view('admin::showprofile',$data);

    }
    public function showtodolist($id,$userid){
        $date = $_POST['date'];
        $query = Tasks::where('date','=',$date)->where('user_id','=',$userid)->get();
        $count = count($query);
        return response()->json(['tasks' => $query,'count'=>$count]);
    }
    public function selectweekormonth($id,$userid){
        $data = $_POST['data'];
        $arr = [];
        if($data == "week"){
            $qw = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('W');});
            foreach ($qw as $key => $value) {
                $interval = $value[0]."=>".$value[count($value)-1];
                $arr["w".$key] = $interval;
            }

        }elseif($data == "month"){
            $qw = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('m');});
            foreach ($qw as $key => $value) {
                $month = Carbon::parse($value[0])->format('F');
                $arr["m".$key] = $month;
                
            }
        }
        return response()->json(['data'=> $arr]);
    }
    public function showgraph($id,$userid,$date){

        $data = $date;
        
        $datadata = [];
        $datachin = [];
        $datachout = [];

        if($data[0] == 'w'){
            $data = substr($data,1);
            $check = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('W');});
            foreach ($check as $key => $value) {
                if($key == $data){
                    
                    foreach($value as $val){
                        $timechin = Times::select('date','time_checkin')->where('user_id','=',$userid)->where('date','=',$val)->where('time_checkin','!=',null)->get();
                        $timechout = Times::select('date','time_checkout')->where('user_id','=',$userid)->where('date','=',$val)->where('time_checkout','!=',null)->get();
                        
                        $timechin = $timechin[0];
                        $timechout =$timechout[count($timechout)-1];
                        $timedate = $timechin->date;

                        
                        
                        
                        $checkintime = Carbon::parse($timechin->time_checkin)->format("H.i");
                        $checkouttime = Carbon::parse($timechout->time_checkout)->format("H.i");
                        array_push($datachin,$checkintime);
                        array_push($datachout,$checkouttime);
                        array_push($datadata,$timedate);
                        // $graph = [$timechin->date,$timechin->time_checkin,$timechout->time_checkout];  
                        // array_push($datagraph,$graph); 
                        // $index = $index+1;
                    }
                   
                }
            }
            
        }elseif($data[0] == 'm'){
            $data = substr($data,1);
            $check = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('m');});
            foreach ($check as $key => $value) {
                if($key == $data){
                    
                    foreach($value as $val){
                        $timechin = Times::select('date','time_checkin')->where('user_id','=',$userid)->where('date','=',$val)->where('time_checkin','!=',null)->get();
                        $timechout = Times::select('date','time_checkout')->where('user_id','=',$userid)->where('date','=',$val)->where('time_checkout','!=',null)->get();
                        $timechin = $timechin[0];
                        $timechout =$timechout[count($timechout)-1];
                        $timedate = $timechin->date;

                        
                        
                        
                        $checkintime = Carbon::parse($timechin->time_checkin)->format("H.i");
                        $checkouttime = Carbon::parse($timechout->time_checkout)->format("H.i");
                        array_push($datachin,$checkintime);
                        array_push($datachout,$checkouttime);
                        array_push($datadata,$timedate);
                    }
                    
                }
            } 
        }
        
       
        // $date = ["12","13","14","15","16"];
        // $timechin = [11,12,13,14,15];
        // $timechout = [20,21,22,23,24];
        
        return response()->json(['date'=>$datadata,'timechin'=>$datachin,'timechout'=>$datachout]);
        
        

    }

    public function editadmin($id,$userid){
        $profile = User::find($userid);

        // echo $profile;
        return view('admin::editadmin')->with('profile',$profile);
    }
    public function editprocess(Request $request,$id,$userid){
        
        $profile = User::find($userid);
        $profile->name = $request->name;
        $profile->id_card = $request->id_card;
        $profile->gender = $request->gender;
        $profile->university = $request->university;
        $profile->major = $request->major;
        $profile->faculty = $request->faculty;
        $profile->birt_date = $request->birt_date;
        $profile->save();

        $profile = Admin::find($userid);
        $profile->name = $request->name;
        $profile->save();

        
        $url = "admin/$id/member";           
        // return redirect('/site/users/{id}')->action('BlogController@show', ['id' => $id]);
        return redirect($url);
    }
    public function createnewadmin(){
        return view('admin::createnewadmin');
    }
    public function createnewadminprocess(Request $request,$id){

        $newadmin = new User;
        $newadmin->name = $request->name;
        $newadmin->id_card = $request->id_card;
        $newadmin->email = $request->email;
        $newadmin->gender = $request->gender;
        $newadmin->birt_date = $request->birt_date;
        $newadmin->university = $request->university;
        $newadmin->faculty = $request->faculty;
        $newadmin->major = $request->major;
        $newadmin->password = bcrypt($request->password) ;
        $newadmin->role = "admin";
        $newadmin->type = "general" ;
        $newadmin->save();

        $admin = new Admin;
        $admin->user_id = $newadmin->id;
        $admin->name = $newadmin->name;
        $admin->email = $newadmin->email;
        $admin->role = $newadmin->role;
        $admin->password = $newadmin->password;
        $admin->save();

        return view('admin::createnewadminsuccess');

        // $newadmin->image = $request->image;


    }
    public function deleteadmin($id,$userid){
        Admin::where('user_id','=',$userid)->delete();
        User::find($userid)->delete();

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
