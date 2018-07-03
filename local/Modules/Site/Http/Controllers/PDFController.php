<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use PDF;
use App\Times;
use App\Tasks;
use App\User;
use Carbon\carbon;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
<<<<<<< HEAD
    {
        
        return view('site::Login-after/pdf');
=======
    {   
        return view('site::Login-after.pdf');
>>>>>>> 7270924b1f75e0f9559821f5761f4b91782f742b
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function PDFcheckincheckout($id)
    {
        $date = "2018";
        // $data = [];
        // $checkin = Times::where('user_id','=',$id)->where('time_checkin','!=',null)->get()->groupBy('date');
        // $checkout = Times::where('user_id','=',$id)->where('time_checkout','!=',null)->get()->groupBy('date');


        $datadata = [];
        
        $checkintime;
        $checkouttime;
        $check = Times::where('user_id','=',$id)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('Y');});
        // echo "<pre>";
        // echo $check;
        foreach ($check as $key => $value) {
            if($key == $date){
                foreach ($value as $val) {
                   $datain = Times::where('user_id','=',$id)->where('date','=',$val)->where('time_checkin','!=',null)->get();
                   $dataout = Times::where('user_id','=',$id)->where('date','=',$val)->where('time_checkout','!=',null)->get();
                //    echo "<pre>";
                   if(count($datain)!=0){
                        $checkintime = Carbon::parse($datain[0]->time_checkin)->format("H:i:s");
                    // echo "checkin : ".$checkintime."<br>";
                   }else{
                       $checkintime = '';
                   }
                   if(count($dataout)!=0){
                        $checkouttime = Carbon::parse($dataout[count($dataout)-1]->time_checkout)->format("H:i:s");
                    // echo "checkout : ".$checkouttime;
                   }else{
                        $checkouttime = '';
                    }
                    $val = Carbon::parse($val)->format("d F Y");
                //    echo "<br>--------------------------------------------------<br>";
                   array_push($datadata,['date'=>$val,'time_checkin'=>$checkintime,'time_checkout'=>$checkouttime]);
                }
            }
        }
        $profile = User::find($id);
        // // exit();
        // return view('site::Login-after/checkincheckoutpdf',compact('datadata','profile'));
        $pdf = PDF::loadView('site::Login-after/checkincheckoutpdf',compact('datadata','profile'));
        return $pdf->download('checkincheckout.pdf');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function PDFtodolist($id)
    {
        $data = "2019 10";
        $datadata = [];
        $datadate = [];

        $valueday;
        
        // $check = Tasks::where('user_id','=',$id)->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('Y m');});
        $check = Tasks::where('user_id','=',$id)->pluck('date','date')->groupBy(function($date){return Carbon::parse($date)->format('Y m');});
        // $check = Tasks::select('detail')->where('user_id','=',$id)->groupBy('date')->pluck('date','detail')->groupBy(function($date){return Carbon::parse($date)->format('Y m');});
        // echo "<pre>";
        // echo $check;
        foreach ($check as $key => $value) {
            // echo "<pre>";
            // echo $key;
            if($key == $data){
                
                foreach ($value as $date) {
                    $data = Tasks::select('date','detail')->where('user_id',$id)->where('date','=',$date)->pluck('detail');
                    // foreach ($detail as $value) {
                    //     echo "<pre>";
                    //     echo $value;
                        
                    // }
                    
                    $date = Carbon::parse($date)->format("d F Y");
                    array_push($datadata,['key'=>$date,'data'=>$data]);
                }
            }

        }
        // foreach($datadata as $value){
        //     print_r($value);
        // } 
        $profile = User::find($id);
        
        // return view('site::Login-after/todolistpdf', compact('datadata','profile'));
        
        $pdf = PDF::loadView('site::Login-after/todolistpdf', compact('datadata','profile'));
        return $pdf->download('todolist.pdf');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('site::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('site::edit');
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
