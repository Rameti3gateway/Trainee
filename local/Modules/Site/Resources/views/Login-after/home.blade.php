@extends('site::layouts.app')
   <style>
            #t{              
               background-image: url('/storage/image/bg.jpg');
               /* background-color: black; */
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
            .welcome-site{                
                text-align: center;                
                margin-bottom: 5%              
            }
            .detial-home{
                text-align: center;
                margin-top: 5%;
            }
            h1{
            color: red;
            }
            
            /*hover*/ 
   </style>
@section('content')    
    <section class="container welcome-site "> 
        <div>
        <hr>   
            <img src="{{url('/storage/image/classroom.png')}}"> 
            <h1  class="jumbotron">Welcome To Site</h1>
            <h5>Something short and leading about the
                collection below—its contents, 
            the creator, etc. Make it short and sweet,
             but not too short so folks don't 
            simply skip over it entirely.</h5>           
            <p id="txt"></p>
        <hr>   
         </div>   
    </section>         
    <div class="container detial-home">
        <div class="row">            
            <div class="col-md-6">
                <img src="{{url('/storage/image/user.png')}}">
                 @php
                 
                        $id =  Auth::user()->id;
                        $url = "site/users/$id";                     
                 @endphp 
                <h3>
                    <a href="{{url($url)}}">Profile</a>
                </h3>
            </div>
            <div class="col-md-6">
                <img src="{{url('/storage/image/todo.png')}}">
                <h3><a href="#">Task list</a></h3>
            </div>           
        </div>       
        <div class="row">
            <div class="col">
                <div>
                   <img src="{{url('/storage/image/check.png')}}">
                        @php                    
                            $id =  Auth::user()->id;
                            $url1 = "site/users/$id/checkinout";                     
                        @endphp 
                     <h3><a href="{{url($url1)}}">Checkin-checkout</a></h3>                    
                </div>
            </div> 
        </div>                
    </div>    
 <!-- time -->
<script type="text/javascript">
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
@endsection
