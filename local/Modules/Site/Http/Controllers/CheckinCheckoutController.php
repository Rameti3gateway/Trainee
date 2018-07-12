<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Times;
use Carbon\Carbon;
class CheckinCheckoutController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acss = array('../assets/site/css/home/checkinout/checkinout.css');
        $this->data = array(
            'style' => $acss
        );       
        return view('site::Login-after.checkinout',$this->data);
    }


    public function sep($id)
    {
        $data = $_POST['data'];
        
        if($data == "CheckIn"){
            
            // echo "check in";
            $this->updateCheckIn($id);
        }else{
            // echo "check out";
            $this->updateCheckOut($id);
        }
    }

  
    public function updateCheckIn($id)
    {
        
        date_default_timezone_set("Asia/Bangkok");
        $current = Carbon::now();
        
        $checkin = new Times;
        $checkin->date = $current->toDateString();
        // $checkin->date = "2019-10-10";
        $checkin->user_id = $id;
        $checkin->time_checkin = $current;
        $checkin->save();
        echo "check in success";        
    
        // return response()->json(['tasks'=> $tasks]);
    }
     public function updateCheckOut( $id)
    {
        
        date_default_timezone_set("Asia/Bangkok");
        $current = Carbon::now();
        $checkout = new Times;
        $checkout->date = $current->toDateString();
        // $checkout->date = "2019-10-10";
        $checkout->user_id = $id;
        $checkout->time_checkout = $current;
        $checkout->save();
        echo "check out success";        
         
        // return response()->json(['tasks'=> $tasks]);
        
    }

    
}
