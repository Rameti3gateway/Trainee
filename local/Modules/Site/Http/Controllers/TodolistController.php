<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Tasks;
use App\Times;
use Auth;
use Carbon\Carbon;
date_default_timezone_set("Asia/Bangkok");
class TodolistController extends Controller
{  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data['date'] = $_GET['date'];
        
        // $id = Auth::user()->id;
       
        $date = Times::select('date')->where('user_id','=',$id)->get();
        $count = count($date);
        
        if($count== 0){
            return redirect('/home');

        }else{
           
            $mydate = date('Y-m-d');
            $id = Auth::user()->id;
            //check in only

            if( $data['date'] == null){
                $data['recentdate']= Times::select('date')->where('user_id','=',$id)->where('time_checkin','!=',null)->groupBy('date')->orderBy('date','desc')->paginate(1)->pluck('date','date');
            }else{
                $data['recentdate'] = $data['date'];
            }
            
            $data['choosedate']= Times::select('date')->where('user_id','=',$id)->where('time_checkin','!=',null)->groupBy('date')->orderBy('date','desc')->paginate(5)->pluck('date','date');
            
            
            $data['tasks'] = Tasks::where('user_id','=',$id)->where('date','=',$data['recentdate'])->get();

            return view('site::login-after.tasks',$data);
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function BacktoTaskForm($id){
        
        return redirect("/users/<?php echo Auth::user()->id ?>/todolist");
        // return response()->json(['data'=>$query]);

    }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $date = $_POST['date'];
       
        $query = Tasks::where('user_id','=',$id)->where('date','=',$date)->get();
        $userid = $id;
        $data['id'] = $query->pluck('id');
        // $data['detail'] = $query->pluck('id','detail');
        $data['user_id'] = Auth::user()->id;
        $count = count($query);
        
        return response()->json(['tasks' => $query,'count'=>$count]);
        // $this->choosedate($query); 
        // return view('showtask',$data);
        
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        $date = $_POST['date'];
        $task = $_POST['data'];
        Tasks::find($task)->delete();
        $id = Auth::user()->id;


        $query = Tasks::where('user_id','=',$id)->where('date','=',$date)->get();
        $count = count($query);
        return response()->json(['count'=>$count]);
    }
     public function store(Request $request,$id)
    {
       
        // $data['date'] = $_POST['date'];
        // $data['detail'] = $_POST['detail'];
        
        
        $task = new Tasks;
        $task->user_id = $id;
        $task->date =$request->date;
        $task->detail = $request->detail;
        $task->save();

        
        $id = Auth::user()->id;
        $query = Tasks::find($task->id);

        $data['choosedate']= Times::select('date')->where('user_id','=',$id)->where('time_checkin','!=',null)->groupBy('date')->orderBy('date','desc')->paginate(5)->pluck('date','date');
        $data['recentdate']= $task->date;
        
        $data['tasks'] = Tasks::where('user_id','=',$id)->where('date','=',$data['recentdate'])->get();

        $url = "/site/users/$id/todolist/?date=$task->date";
        return redirect($url);
        
        
        
    }
    
    public function choosedate ($data){
        
        foreach ($data as $value) {
            echo $value;
        }

    }
    public function edittodolist($id,$taskid,$input){
        $edittask = Tasks::find($taskid);
        $edittask->detail = $input;
        $edittask->save();
        return response()->json(['data'=>$input]);

    }
}
