@extends('site::layouts.app')
 {{ Html::style(('../assets/site/css/Admin/index.css')) }}
@section('content')
  <!-- This view is loaded from module: {!! config('admin.name') !!} -->
<body>
	<div class="container text-center animated fadeIn">
        <h1 class="text-center text-success checkinout">Admin Management</h1>        
        <!-- <h3><a href="{{url('site/home')}}">Back To Home</a></h3> -->
        <div class="row">
            <div class="col-lg-6" >
                <form action="http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id; ?>/dashboard" method="get">
                    {{Form::submit('Dashboard',['class'=>'btn btn-primary btn-circle btn-xl hvr-grow'])}}
                </form>                    
            </div>
            <div class="col-lg-6">
                <form action="http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id; ?>/member" method="get">
                    {{ Form::submit('Member',['class'=>'btn btn-danger btn-circle btn-xl hvr-grow']) }}
                </form>
            </div>
        </div>
    </div>
</body>
@stop
