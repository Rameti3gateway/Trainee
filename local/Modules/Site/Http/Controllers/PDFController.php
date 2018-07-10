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
use Auth;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $id=Auth::user()->id;
        $check = Times::where('user_id','=',$id)->groupBy('date')->pluck('date','date')->groupBy(function($date){return Carbon::parse($date)->format('Y-m');});
        $data = [];
        foreach ($check as $key => $value) {
            array_push($data,$key);
        }
     
      
        return view('site::Login-after/pdf',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function PDFcheckincheckout($id,$type,$datadetail)
    {
        $datadata = [];
        $checkintime;
        $checkouttime;
        if($type == "year"){
            $check = Times::where('user_id','=',$id)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('Y');});
        }elseif($type == "month"){
            $datadetail = Carbon::parse($datadetail)->format("Y m");
            $check = Times::where('user_id','=',$id)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('Y m');});
        }
       
        // echo "<pre>";
        // echo $check;
        foreach ($check as $key => $value) {
            if($key == $datadetail){
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
        // exit();
        // return response()->json(['data'=>$datadata]);
        // return view('site::Login-after/checkincheckoutpdf',compact('datadata','profile'));
        $pdf = PDF::loadView('site::Login-after/checkincheckoutpdf',compact('datadata','profile'));
        return $pdf->download('checkincheckout.pdf');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function PDFtodolist($id,$data)
    {
        // $data = "2019 10";
       
        $data = Carbon::parse($data)->format("Y m");
        
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
    public function PDFcheckincheckoutChooseyear($id){
        $check = Times::where('user_id','=',$id)->groupBy('date')->pluck('date')->groupBy(function($date){return Carbon::parse($date)->format('Y');});
        $data = [];
        foreach ($check as $key => $value) {
            array_push($data,$key);
        }
        return response()->json(['data' => $data]);
    }
    public function PDFcheckincheckoutChoosemonth($id){

        $check = Times::where('user_id','=',$id)->groupBy('date')->pluck('date','date')->groupBy(function($date){return Carbon::parse($date)->format('F Y');});
        $data = [];
        foreach ($check as $key => $value) {
            array_push($data,$key);
            
        }
        return response()->json(['data' => $data]);
    }
    
    public function PDFcheckincheckoutChoose($id){
        $data = $_POST['data'];
        if($data == "year"){    
            return $this->PDFcheckincheckoutChooseyear($id);
        }elseif($data=="month" || $data=="interval"){
            return $this->PDFcheckincheckoutChoosemonth($id);
        }
    }
    public function PDFcheckincheckoutinterval($id,$type,$detail1,$detail2){
        $detail1 = Carbon::parse($detail1)->format("Y m");
        $detail2 = Carbon::parse($detail2)->format("Y m");
        $check = Times::where('user_id','=',$id)->pluck('date','date')->groupBy(function($date){return Carbon::parse($date)->format('Y m');});
        // echo $check;
        // echo $detail1;
        // echo $detail2;
        $valueend;
        $data;
        $datadata = [];
        $arraydate = [];
        foreach ($check as $key => $value) {
            if($key == $detail2){
                $valueend = $value[count($value)-1];
            }
        }
        foreach ($check as $key => $value) {
            if($key == $detail1){
                // echo "<pre>";
                // echo $value;
                // echo $value[count($value)-1];
                $data = Times::where('user_id','=',$id)->where('date','>=',$value[0])->where('date','<=',$valueend)->get();
               
                // echo "<br>";
               
                foreach($data as $dat){
                    // echo "<br>";
                    // echo $dat;
                    if(in_array($dat->date,$arraydate)==false){
                        // echo "notfound";
                        // echo $dat->date;
                        array_push($arraydate,$dat->date);
                    }else{
                        // echo "found";
                    }
                    
                }
                // echo "<br>";
                foreach($arraydate as $date){
                    // echo "<pre>";
                    // echo $date;
                    $datain = Times::where('user_id','=',$id)->where('date','=',$date)->where('time_checkin','!=',null)->get();
                    $dataout = Times::where('user_id','=',$id)->where('date','=',$date)->where('time_checkout','!=',null)->get();
                    // echo "<br>";
                    // echo count($datain);
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
                     $date = Carbon::parse($date)->format("d F Y");
                //    echo "<br>--------------------------------------------------<br>";
                    array_push($datadata,['date'=>$date,'time_checkin'=>$checkintime,'time_checkout'=>$checkouttime]);
                }
            }
        }
        $profile = User::find($id);
        // exit();
        // return response()->json(['data'=>$datadata]);
        // return view('site::Login-after/checkincheckoutpdf',compact('datadata','profile'));
        $pdf = PDF::loadView('site::Login-after/checkincheckoutpdf',compact('datadata','profile'));
        return $pdf->download('checkincheckout.pdf');
        
       
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
