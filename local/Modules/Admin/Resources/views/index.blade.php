@extends('admin::layouts.app')
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
  <!-- This view is loaded from module: {!! config('admin.name') !!} -->
<body>
	<div class="container text-center ">
        <h1 class="text-center text-success checkinout">Admin</h1>
        
        <!-- <h3><a href="{{url('site/home')}}">Back To Home</a></h3> -->
        <div class="row">
        <div class="col-lg-6" >
                 <form action="http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id; ?>/dashboard" method="get">
                {{Form::submit('Dashboard',['class'=>'btn btn-primary btn-circle btn-xl'])}}
                 </form>
                
        </div>
        <div class="col-lg-6">
                <form action="http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id; ?>/member" method="get">
                {{ Form::submit('Member',['class'=>'btn btn-danger btn-circle btn-xl']) }}
                </form>
        </div>
        </div>
    </div>
</body>
@stop
