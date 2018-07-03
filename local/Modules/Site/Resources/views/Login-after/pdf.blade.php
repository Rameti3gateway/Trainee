@extends('site::layouts.app')
<style>
   
</style>
@section('content')
@php
    $id = Auth::user()->id;
    $url = "/site/users/$id/report/checkincheckout";
    $url2 = "/site/users/$id/report/todolist";
@endphp
<div class="container">
    <div class="row text-center mt-5 mb-5">
        <div class="col">
            <h1>Generate Report</h1> 
        </div>  
    </div>      
    <div class="row text-center"> 
        <div class="col-lg-6 ">                             
            {{ Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Year','class'=>'form-control']) }}          
            <a href="{{ url("$url") }}"><button class="btn btn-primary mt-5">Checkin&Checkout Report</button> </a>
        </div>      
        <div class="col-lg-6">   
            {{ Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Month','class'=>'form-control']) }}
             <a href="{{ url("$url2") }}"><button class="btn btn-primary mt-5">Todolist Report</button> </a>
         </div>
    </div>  
</div> 
@endsection
