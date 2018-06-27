@extends('site::layouts.app')
<style type="text/css">
       .checkinout{
           margin-top:150px;
           margin-bottom:100px;
       }
       .btn-circle.btn-xl {
            width: 300px;
            height: 300px;
            padding: 10px 16px;
            border-radius: 150px;
            font-size: 30px;
            line-height: 1.33;
        }        
    </style>
@section('content')
<body>
    <div class="container text-center ">
        <h1 class="text-center text-success checkinout">CheckIN-CheckOut</h1>
        <h3><a href="{{url('site/home')}}">Back To Home</a></h3>
        <div class="row">
        <div class="col-lg-6" >
                {{Form::submit('CheckIn',['class'=>'btn btn-primary btn-circle btn-xl','name'=>'check_in','id'=>'check_in'])}}
        </div>
        <div class="col-lg-6">
                {{Form::submit('CheckOut',['class'=>'btn btn-danger btn-circle btn-xl','name'=>'check_out','id'=>'check_out'])}}
        </div>
        </div>
    </div>
	<script type="text/javascript">
		$(function($){
         $("#check_in").click(function(){
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });               
            $.ajax({
                'method':'post',
                'url': 'http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/checkinout/check',
                'data':{data: $("#check_in").val()},
                'success': function(data){                	
                   alert(data) ;            
                }
            });
       });        
     });
        $(function($){
             $("#check_out").click(function(){
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                'method':'post',
                'url': 'http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/checkinout/check',
                'data':{data: $("#check_out").val()},
                'success':function(data){
                    alert(data) ;           
                }
             });
         });
        });
    </script>

<body>
@endsection
