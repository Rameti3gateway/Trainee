@extends('layouts.app')
   <style>
            body{
              
                background-image: url('img/bg.jpg');
            }
            section{
                /*background-color: white;*/
                color: white;
            }
           .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 60px;
            }
            .links > a {
                color: #000;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            img{
                 width: 120px;
                 height: 120px;
            } 
            .cr{                
                text-align: center;                
                margin-bottom: 5%              
            }
            .cc{
                text-align: center;
                margin-top: 5%;
            }
            h1{
            color: red;
            }
            
            /*hover*/ 
   </style>
@section('content')
    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =
            h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script>
    <section> 
        <div class="container cr">  
        <hr>   
            <img src="{{url('img/classroom.png')}}">      
            <h1>Welcome To Site</h1>
            <h5>Something short and leading about the
                collection below—its contents, 
            the creator, etc. Make it short and sweet,
             but not too short so folks don't 
            simply skip over it entirely.</h5>
             <p>Time :<?php echo date("d-m-Y");?></p>
            <span id="txt">
               
           </span>
        <hr>   
         </div>   
    </section>         
    <div class="container cc">
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <img src="{{url('img/user.png')}}">
                    @php
                        $id =  Auth::user()->id;
                        $url = "users/$id";
                    @endphp 
                    <h3>
                        <a href="{{url($url)}}">Profile.</a>
                    </h3>
                </div>
            </div>       
            <div class="col-lg-6">
                <div>
                    <img src="{{url('img/todo.png')}}">
                    <h3><a href="#">Task list</a></h3>
                </div>
            </div>  
        </div>       
        <div class="row">
            <div class="col">
                <div>
                   <img src="{{url('img/ch.png')}}">
                    <h3><a href="#">Checkin-checkout</a></h3>
                </div>
            </div> 
        </div>                
    </div>
@endsection
