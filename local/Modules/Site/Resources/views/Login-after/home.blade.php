@extends('site::layouts.app')
   <style>
           .content {
                text-align: center;
            }            
        
            img{
                 width: 120px;
                 height: 120px;
            } 

            .welcome-site{                
                text-align: center;                               
            }
          .welcome-site .class-room{
                animation-duration: 2s;
                animation-delay:0.1s;
           }
            .detial-home{
                text-align: center;                 
            }                      
   </style>
@section('content')   
<div class="bg-body">   
        <div class="jumbotron welcome-site ">
            <div class="container class-room animated zoomIn">
                <img src="{{url('/storage/image/classroom.png')}}"> 
                <h2>
                    @php
                            $name =  Auth::user()->name;   
                            echo "Welcome ".$name;                 
                    @endphp
                </h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex alias aut earum laboriosam neque. Culpa quia quidem expedita sint nisi nihil nostrum officiis ratione! Laborum aspernatur at non dolor voluptas?</p>
                 <p id="txt"></p>                                        
            </div>
         </div>    
    <div class="container detial-home">
        <div class="row">            
            <div class="col-md-6 animated slideInUp">
                 @php                 
                        $id =  Auth::user()->id;
                        $url = "site/users/$id";                     
                 @endphp 
                <a href="{{url($url)}}"><img src="{{url('/storage/image/user.png')}}"></a>
                <h3><a href="{{url($url)}}">Profile</a></h3>
            </div>
            <div class="col-md-6 animated slideInUp">
                  @php                 
                        $id =  Auth::user()->id;
                        $urltasklist = "site/users/$id/todolist";                     
                 @endphp 
               <a href="{{url($urltasklist)}}"><img src="{{url('/storage/image/todo.png')}}"></a> 
                <h3><a href="{{url($urltasklist)}}">Task list</a></h3>
            </div>           
        </div>       
        <div class="row">
            <div class="col animated slideInDown">                
                @php                    
                    $id =  Auth::user()->id;
                    $urlch = "site/users/$id/checkinout";                     
                @endphp 
                <a href="{{url($urlch)}}"><img src="{{url('/storage/image/check.png')}}"></a>                        
                <h3><a href="{{url($urlch)}}">Checkin-checkout</a></h3>  
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