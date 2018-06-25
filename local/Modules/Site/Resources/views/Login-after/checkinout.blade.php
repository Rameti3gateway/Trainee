@extends('site::layouts.app')
<style type="text/css">
        .btn-circle.btn-xl {
            width: 300px;
            height: 300px;
            padding: 10px 16px;
            border-radius: 150px;
            font-size: 24px;
            line-height: 1.33;
        }
    </style>
@section('content')
<body>
<div class="container">
    <div class="row">
       <div class="col-lg-6" >
            {{Form::submit('Check In',['class'=>'btn btn-danger btn-circle btn-xl','name'=>'check_out','onClick'=>'check_in()'])}}
       </div>
       <div class="col-lg-6">
            {{Form::submit('Check Out',['class'=>'btn btn-danger btn-circle btn-xl','name'=>'check_out'])}}
       </div>
    </div>
</div>
<body>
@endsection
