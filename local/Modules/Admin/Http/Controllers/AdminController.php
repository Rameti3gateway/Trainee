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
use Illuminate\Support\Facades\Validator;
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
        $data['choosedate']= Times::select('date')->where('user_id','=',$userid)->where('time_checkin','!=',null)->groupBy('date')->orderBy('date','desc')->pluck('date');
        $arr = $data['choosedate'];
        $arrayindex=[];
        $arraydata=[];
        array_push($arrayindex,"0");
        array_push($arraydata,"Please select");
        foreach($arr as $a){
            $val = Carbon::parse($a)->format('d F Y');
            array_push($arrayindex,$a);
            array_push($arraydata,$val);
        }
        $data['choosedate'] = array_combine($arrayindex,$arraydata);
        

        $queryweek = Times::select('date')->where('user_id','=',$userid)->groupBy('date')->get()->groupBy(function($date){return Carbon::parse($date->date)->format('W Y');});
        $qw = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('m');});
        foreach ($qw as $key => $value) {
            $month = Carbon::parse($value[0])->format('F Y');
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
            $qw = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('W Y');});
            foreach ($qw as $key => $value) {
                $a = Carbon::parse($value[0])->format('d F Y');
                $b = Carbon::parse($value[count($value)-1])->format('d F Y');
                $interval = $a." => ".$b;
                $arr["w".$key] = $interval;
            }

        }elseif($data == "month"){
            $qw = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('m Y');});
            foreach ($qw as $key => $value) {
                $month = Carbon::parse($value[0])->format('F Y');
                $arr["m".$key] = $month;
                
            }
        }
        return response()->json(['data'=> $arr]);
    }
    public function showgraph($id,$userid,$date){

        $data = $date;
        $test;
        $datadata = [];
        $datachin = [];
        $datachout = [];

        if($data[0] == 'w'){
            $data = substr($data,1);
            $check = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('W Y');});
            foreach ($check as $key => $value) {
                if($key == $data){
                    
                    foreach($value as $val){
                        $timechin = Times::select('date','time_checkin')->where('user_id','=',$userid)->where('date','=',$val)->where('time_checkin','!=',null)->get();
                        $timechout = Times::select('date','time_checkout')->where('user_id','=',$userid)->where('date','=',$val)->where('time_checkout','!=',null)->get();
                        
                        if(count($timechin) != 0){
                            $timechin = $timechin[0];
                            $checkintime = Carbon::parse($timechin->time_checkin)->format("H:i:s");
                        }else{
                            $checkintime = null;
                        }

                        if(count($timechout) != 0){
                            $timechout =$timechout[count($timechout)-1];
                            $checkouttime = Carbon::parse($timechout->time_checkout)->format("H:i:s");
                        }else{
                            $checkouttime = null;
                        }

                        
                        $timedate = $val;

                        
                        
        
                        array_push($datachin,$checkintime);
                        array_push($datachout,$checkouttime);
                        array_push($datadata,$timedate);
                       
                    }
                    if(count($value) == 1){
                        $date = new Carbon();
                        $date->setISODate(substr($data, -4),substr($data,0,2)); // 2016-10-17 23:59:59.000000
                        $start = $date->startOfWeek()->toDateString(); // 2016-10-17 00:00:00.000000
                        $end = $date->endOfWeek()->toDateString(); // 2016-10-23 23:59:59.000000
                        $test = $start;
                        $valdate = $datadata[0];
                        $a = Carbon::parse($valdate)->addDays(1)->toDateString();
                        array_push($datadata,$a);
                        array_push($datachin,null);
                        array_push($datachout,null);
                        
                    }else{
                        $test = null;
                    }
                   
                }
            }
            
        }elseif($data[0] == 'm'){
            $test = null;
            $data = substr($data,1);
            $check = Times::where('user_id','=',$userid)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('m Y');});
            foreach ($check as $key => $value) {
                if($key == $data){
                    
                    foreach($value as $val){
                        $timechin = Times::select('date','time_checkin')->where('user_id','=',$userid)->where('date','=',$val)->where('time_checkin','!=',null)->get();
                        $timechout = Times::select('date','time_checkout')->where('user_id','=',$userid)->where('date','=',$val)->where('time_checkout','!=',null)->get();
                        if(count($timechin) != 0){
                            $timechin = $timechin[0];
                            $checkintime = Carbon::parse($timechin->time_checkin)->format("H:i:s");
                        }else{
                            $checkintime = null;
                        }

                        if(count($timechout) != 0){
                            $timechout =$timechout[count($timechout)-1];
                            $checkouttime = Carbon::parse($timechout->time_checkout)->format("H:i:s");
                        }else{
                            $checkouttime = null;
                        }

                        
                        $timedate = $val;
                        array_push($datachin,$checkintime);
                        array_push($datachout,$checkouttime);
                        array_push($datadata,$timedate);
                    }
                    if(count($value) == 1){
                        $date = new Carbon();
                        $date->setISODate(substr($data, -4),substr($data,0,2)); // 2016-10-17 23:59:59.000000
                        $start = $date->startOfWeek()->toDateString(); // 2016-10-17 00:00:00.000000
                        $end = $date->endOfWeek()->toDateString(); // 2016-10-23 23:59:59.000000
                        $test = $start;
                        $valdate = $datadata[0];
                        $a = Carbon::parse($valdate)->addDays(1)->toDateString();
                        array_push($datadata,$a);
                        array_push($datachin,null);
                        array_push($datachout,null);
                        
                        
                    }else{
                        $test = null;
                    }
                    
                }
            } 
        }

        
        return response()->json(['date'=>$datadata,'timechin'=>$datachin,'timechout'=>$datachout,'test'=>$test]);
        
        

    }

    public function editadmin($id,$userid){
        $profile = User::find($userid);

        // echo $profile;
        return view('admin::editadmin')->with('profile',$profile);
    }
    public function editprocess(Request $request,$id,$userid){

        $validator = Validator::make($request->all(),[
            'id_card'=> 'required|numeric|digits:13|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required',
        ]);
        
        if($validator->passes()){
            $profile = User::find($userid);

            if($request->image != null){
                $photoName = 'admin_'.uniqid().'_'.time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move('../upload/img/site/admin-profile-image', $photoName);
                $profile->image = $photoName;
            }

            $profile->name = $request->name;
            $profile->id_card = $request->id_card;
            $profile->gender = $request->gender;
            $profile->birt_date = $request->birt_date;
            
            $profile->save();

            $adminprofile = Admin::where('user_id','=',$userid)->first();
            $adminprofile->name = $request->name;
            $adminprofile->save();

            
            $url = "admin/$id/member";           
            // return redirect('/site/users/{id}')->action('BlogController@show', ['id' => $id]);
            return redirect($url);
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
    }
    public function createnewadmin(){
        return view('admin::createnewadmin');
    }
    public function createnewadminprocess(Request $request,$id){
        
        if($request->image != null){
            $photoName = 'admin_'.uniqid().'_'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('../upload/img/site/admin-profile-image', $photoName);
        }else{
            $photoName = "default.jpg";
        }
        $newadmin = new User;
        $newadmin->name = $request->name;
        $newadmin->id_card = $request->id_card;
        $newadmin->email = $request->email;
        $newadmin->gender = $request->gender;
        $newadmin->birt_date = $request->birt_date;
        $newadmin->image = $photoName;
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

        return $this->member();
    }
    public function deleteadmin($id,$userid){
        Admin::where('user_id','=',$userid)->delete();
        User::find($userid)->delete();

    }
}
