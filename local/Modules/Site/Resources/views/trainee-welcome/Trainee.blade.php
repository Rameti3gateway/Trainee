@extends('site::layouts.app')
@section('title','Welcome')
    <style>  
            .content-main {
                margin-top:200px;
                text-align: center;              
                animation-duration: 2s;
                animation-delay:0.1s;	
                /* background-color:red; */
            }

            .title {
                font-size: 84px;
            }

            .links > a {                
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }            
    </style>
@section('content')  
    <div class="flex-center position-ref full-height content-main">       
        <div class="content animated fadeInUp">
            <div class=" title m-b-md">
                 Trainee System
            </div>
            <div class="links">
                @if (Auth::check())
                <h2><a href="site/home">Welcome Click To Site</a> </h2>  
                <h3>*---------------------*</h3>
                <h5>i3gateway</h5>
                <h6>digital agency</h6>
                <h3>*---------------------*</h3>         
                 @else
                <h3>*---------------------*</h3>
                <h5>i3gateway</h5>
                <h6>digital agency</h6>
                <h3>*---------------------*</h3>
                 @endif
            </div>
        </div> 
    </div>     
@endsection