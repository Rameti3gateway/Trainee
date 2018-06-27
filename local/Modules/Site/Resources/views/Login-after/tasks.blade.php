@extends('site::layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});
    $(function($){
        $('body').on('change','#selectdate',function(){

            $.ajax({
                'type':'POST',
                'url': "http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/todolist/choose",
                'cache':false,
                'data':{date:$("#selectdate").val()},
                'success':function(data){

                    if(data.count != 0){
                        $("#displaytask").empty();

                        $("#displaytask").append(" <div class='panel panel-default'>"+
                            "<div class='panel-heading'>Current Tasks</div>"+
                            "<div class='panel-body'>"+
                            "<table class='table table-striped task-table'>"+
                            "<thead><th>Task</th><th>&nbsp;</th></thead>"+
                            "<tbody id='choosedate' >"

                            +"</tbody>"+
                            "</table>"+
                            "</div>"+
                            "</div> ");

                        $("#choosedate").empty();
                        $.each(data.tasks,function(index,value){
                            $("#choosedate").append("<tr id='trid-"+value.id+"'><td >"+value.detail+"</td><td><button class='btn btn-danger' id='deletebutton-"+value.id+"'><i class='fa fa-btn fa-trash'></i>Delete</button></td></tr>");      
                            $("#deletebutton-"+value.id).click(function(){
                                $.ajax({
                                    'type':'POST',
                                    'url':"http://localhost:8080/users/"+value.id+"/todolist/delete/"+value.user_id,
                                    'cache':false,
                                    'data':{data:value.id,date:$("#selectdate").val()},
                                    'success':function(data){
                                        if(data.count == 0){
                                            $("#displaytask").empty();
                                        }else{
                                            $("#trid-"+value.id).empty();
                                        }

                                    }
                                })
                            });
                        });
                    }else{
                        $("#displaytask").empty();
                    }

                }
            });


        });
        $( "#addtasks" ).click(function() {
          $( "#addtaskform" ).submit(function(data){
             alert(data.data.detail);
          });
        });
        



    });
          

</script>
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Task
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                
                @php
                $id =  Auth::user()->id;
                $url = "users/$id/todolist/task";
                @endphp 

                <!-- New Task Form -->
                <!-- action="http://localhost:8080/users/<?php /*echo Auth::user()->id; */?>/todolist/task" method="post"  -->
                <form action="http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/todolist/task" method="post" class="form-horizontal" id="addtaskform">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                    <div  class="form-group">
                        <label for="detail" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-6">
                            <input type="text" name="detail" id="detail" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-sm-6">
                            {{ Form::select('date',$choosedate, null , ['class' => 'form-control','id'=>'selectdate']) }}
                        </div>
                    </div>



                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default" id="addtasks"  >
                                <i class="fa fa-btn fa-plus"></i>Add Task
                            </button>
                        </div>
                    </div>

                </form>

            </form>
        </div>
    </div>    

    <!-- Current Tasks -->
    <div  id="displaytask">
        @if (count($tasks) )
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks 
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody id="choosedate" >
                        @foreach ($tasks as $task) 
                        <tr id="{{'trid-'.$task->id}}" > 
                            <td class="table-text" id="choosedate">
                                <div>{{ $task->detail }}</div>
                            </td>
                            <td> 
                              <!-- <form action="{{ url('/users/'.$task->id.'/todolist/delete/'.$task->user_id) }}" method="post"> -->
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger" id="{{'deletebutton-'.$task->id}}"  value="{{$task->id}}">
                                    <i class="fa fa-btn fa-trash"></i>Delete
                                </button>

                               <script type="text/javascript">
                                $.ajaxSetup({
                                      headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    }
                                });
                               $(function($){
                                    $("#deletebutton-"+<?php echo $task->id ?>).click(function(){
                                        // alert($("#deletebutton-"+<?php echo $task->id ?>).val());
                                        $.ajax({
                                            'type':'POST',
                                            'url':"http://localhost/Laravel/Trainee/local/site/users/"+<?php echo $task->id ?>+"/todolist/delete/"+<?php echo $task->user_id ?>,
                                            'cache':false,
                                            'data':{data:<?php echo $task->id ?>,date:$("#selectdate").val()},
                                            'success':function(data){
                                                if(data.count == 0){
                                                    $("#displaytask").empty();
                                                }else{
                                                    $("#trid-"+<?php echo $task->id ?>).empty();
                                                }

                                            }
                                        })
                                    });
                               });
                               </script>

                            <!-- </form> -->
                        </td> 
                    </tr> 
                    @endforeach  
                </div>
            </tbody>
        </table> 
    </div> 
</div> 
@endif 
</div>


</div>
</div>
@endsection
