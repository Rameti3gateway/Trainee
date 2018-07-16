@extends('site::layouts.app')
@section('content')
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
                'url': "http://localhost/trainee/site/users/<?php echo Auth::user()->id; ?>/todolist/choose",
                'cache':false,
                'data':{date:$("#selectdate").val()},
                'success':function(data){
                    if(data.count != 0){
                        $("#displaytask").empty();

                        $("#displaytask").append("<div class='panel panel-default'>"+
                            "<div class='panel-heading'>Current Tasks</div>"+
                            "<div class='panel-body'>"+
                            "<table class='table table-striped task-table'>"+
                            "<thead><th>Task</th><th>&nbsp;</th></thead>"+
                            "<tbody id='choosedate' >");
                        
                        $("#choosedate").empty();
                        $.each(data.tasks,function(index,value){
                            $("#choosedate").append(
                                "<tr id='trid-"+value.id+"'>"+
                                    "<td id='inputtodolist-"+value.id+"'>"+value.detail+"</td>"+
                                    "<td><div class='text-right'>"+
                                        "<button class='btn btn-primary' id='editbutton-"+value.id+"' >"+
                                            "<i><span class='glyphicon glyphicon-pencil'></span>Edit</i>"+
                                        "</button>&nbsp;"+
                                        "<button class='btn btn-danger' id='deletebutton-"+value.id+"'>"+
                                            "<i class='fa fa-btn fa-trash'></i>Delete"+
                                        "</button>"+
                                        
                                    "</div></td>"+
                                "</tr>");      
                            $("#deletebutton-"+value.id).click(function(){
                                $.ajax({
                                    'type':'POST',
                                    'url':"http://localhost/trainee/site/users/"+value.id+"/todolist/delete/"+value.user_id,
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
                            console.log(value.detail);
                            var oldvalue;
                            var count = 0;
                            $("#editbutton-"+value.id).click(function(){
                                var data =value.detail;
                                console.log(data);
                                swal({
                                    title: 'Edit To do list',
                                    input:'text',
                                    showCancelButton: true,
                                    inputValue:(count == 0)? data:oldvalue,
                                    preConfirm:(input)=>{
                                        return fetch("/trainee/site/users/"+value.user_id+"/todolist/"+value.id+"/edittodolist/"+input)
                                        .then(response =>{
                                            return response.json();
                                        })   
                                    }  
                                }).then(response =>{
                                    oldvalue = response.value.data;
                                    $("#inputtodolist-"+value.id).html(response.value.data);
                                })
                                count = count + 1;

                            })
                        });
                        $("#displaytask").append("</tbody>"+
                        "</table>"+
                        "</div>"+
                        "</div> ");

                       
                        
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
    <div class="col-sm-offset-2 col-sm-8 ">
        <div class="panel panel-default animated pulse">
            <div class="panel-heading">Task</div>
            <div class="panel-body">

                <!-- Display Validation Errors -->
                @php
                $id =  Auth::user()->id;
                $url = "users/$id/todolist/task";
                @endphp 

                <!-- New Task Form -->
                <form action="http://localhost/trainee/site/users/<?php echo Auth::user()->id; ?>/todolist/task" method="post" class="form-horizontal" id="addtaskform">
                    {{ csrf_field() }}
                    <!-- Task Name -->
                    <div  class="form-group">
                            {{ Form::label('Task','',['class' => 'col-sm-3 control-label'])}}                        
                        <div class="col-sm-6">
                            {{Form::text('detail','',['class'=>'form-control','autofocus'=>'autofocus','required'=>'required']) }} 
                        </div>
                    </div>
                    <div class="form-group">                        
                        <div class="col-sm-6 col-sm-offset-3">
                        {{ Form::select('date',$choosedate, $recentdate , ['class' => 'form-control','id'=>'selectdate']) }}
                        </div>
                    </div>
                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-7">
                            <button type="submit" class="btn btn-default" id="addtasks">                                
                               <i><span class="glyphicon glyphicon-plus-sign"></span>Add Task</i>
                            </button>
                        </div>
                    </div>
                </form>  
            </div>
    </div>  

    <!-- Current Tasks -->
    <div  id="displaytask" class="animated fadeIn">
        @if (count($tasks) )
        <div class="panel panel-default">
            <div class="panel-heading">Current Tasks </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody id="choosedate" >
                        @foreach ($tasks as $task) 
                        <tr id="{{'trid-'.$task->id}}" > 
                            <td class="table-text " id="choosedate">
                                <div id="inputtodolist-{{$task->id}}">{{ $task->detail }}</div>
                            </td>
                            <td> 
                                {{ csrf_field() }}
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" id="editbutton-{{$task->id}}"  value="">
                                           <i><span class="glyphicon glyphicon-pencil"></span>Edit</i>
                                    </button>
                                    <button type="submit" class="btn btn-danger" id="{{'deletebutton-'.$task->id}}"  >
                                        <i><span class=""></span>Delete</i>
                                    </button>
                                </div>       
                                <script type="text/javascript">
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                        }
                                    });
                                    $(function($){
                                            $("#deletebutton-"+<?php echo $task->id ?>).click(function(){
                                            swal({
                                                    title: 'Are you sure delete?',
                                                    text: "Do you want to delete it!",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Yes, delete it!'
                                                    }).then((result) => {
                                                    if (result.value) {  
                                                        swal(
                                                            'Deleted!',
                                                            'Your task has been deleted.',
                                                            'success'
                                                        )
                                                        $.ajax({
                                                        'type':'POST',
                                                        'url':"http://localhost/trainee/site/users/"+<?php echo $task->id ?>+"/todolist/delete/"+<?php echo $task->user_id ?>,
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
                                                    }
                                                });                                                    
                                            });
                                            var oldvalue;
                                            var count = 0;
                                            $("#editbutton-{{$task->id}}").click(function(){
                                                var data = "{{$task->detail}}";
                                                console.log(data);
                                                swal({
                                                    title: 'Edit To do list',
                                                    input:'text',
                                                    showCancelButton: true,
                                                    inputValue:(count == 0)? data:oldvalue,
                                                    preConfirm:(input)=>{
                                                        return fetch("/trainee/site/users/{{$task->user_id}}/todolist/{{$task->id}}/edittodolist/"+input)
                                                        .then(response =>{
                                                            return response.json();
                                                        })   
                                                    }  
                                                }).then(response =>{
                                                    oldvalue = response.value.data;
                                                    $("#inputtodolist-{{$task->id}}").html(response.value.data);
                                                })
                                                count = count + 1;

                                            })
                                    });
                                </script>
                            </td> 
                        </tr> 
                        @endforeach  
                    </tbody>
                </table>  
            </div>
        </div>  
        @endif 
    </div> 
    <div class="text-center">
        <a href="{{url('/site/home')}}"><button type="button" class="btn btn-primary btn-lg " >Back</button></a>    
    </div>    
</div> 
@endsection
