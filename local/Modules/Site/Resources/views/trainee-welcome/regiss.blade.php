@extends('site::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 style="text-align: center;">Welcome To Website </h1></div>    
                <div style="text-align: center;">
                    <a href="{{ url('/') }}" class="btn btn-primary">Back To Home</a>
                 </div> 
           </div>
        </div>
    </div>
</div>
@endsection
