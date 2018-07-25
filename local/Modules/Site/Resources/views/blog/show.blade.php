@extends('site::layouts.app')
@section('content')
<div class="container-fluid  animated fadeIn">
    <div class="row">      
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Your Profile</strong></div>
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                        <div class="panel-body " style="text-align:center">
                            <h2>User Profile Card</h2>   
                            <div class="animated zoomIn">
                                @if($blog->type == "facebook" || $blog->type == "google" )                                
                                    @if(strstr($blog->image,'_',true) == 'user')
                                        <img class="hvr-grow" src="{{url('../upload/img/site/profile-image/'.$blog->image )}}" alt="photo" style="width:20%">
                                    @else
                                        <img class="hvr-grow" src="{{$blog->image}}" alt="photo" style="width:20%">
                                    @endif
                                @elseif($blog->type == 'general')
                                    
                                    <img class="hvr-grow" src="{{url('../upload/img/site/profile-image/'.$blog->image )}}" alt="photo" style="width:20%">
                                                             
                                @endif   
                            </div>         
                        </div>
                        <div class="panel-body "style="">
                        
                            <label for="name" class="col-md-4 control-label">Name : </label>
                            <div class="col-md-6">
                            @if(Auth::user()->name == null) 
                                <p>-</p>                            
                            @else 
                                <p>{{$blog->name}}</p>                            
                            @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <label for="email" class="col-md-4 control-label">Email Address : </label>
                            <div class="col-md-6">
                                @if(Auth::user()->email == null) 
                                    <p>-</p>
                                @else
                                    <p>{{$blog->email}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <label for="id_card" class="col-md-4 control-label">ID Card : </label>
                            <div class="col-md-6">
                            @if(Auth::user()->id_card == null)
                                    <p>-</p>
                            @else
                                    <p>{{$blog->id_card}}</p>
                            @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <label for="gender" class="col-md-4 control-label">Gender : </label>
                            <div class="col-md-6">
                            @if(Auth::user()->gender == null)
                                    <p>-</p>
                            @else
                                    <p>{{$blog->gender}}</p>
                            @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <label for="birt_date" class="col-md-4 control-label">Birtday Date : </label>
                            <div class="col-md-6">
                                @if(Auth::user()->birt_date == null)
                                    <p>-</p>
                                @else
                                    <p>{{\Carbon\Carbon::parse($blog->birt_date,'Asia/Bangkok')->format('d F Y')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <label for="university" class="col-md-4 control-label">University : </label>
                            <div class="col-md-6">
                            @if(Auth::user()->university == null)
                                    <p>-</p>
                            @else
                                    <p>{{$blog->university}}</p>
                            @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <label for="faculty" class="col-md-4 control-label">Faculty : </label>
                            <div class="col-md-6">
                            @if(Auth::user()->faculty == null)
                                    <p>-</p>
                            @else
                                    <p>{{$blog->faculty}}</p>
                            @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            <label for="major" class="col-md-4 control-label">Major : </label>
                            <div class="col-md-6">
                            @if(Auth::user()->major == null)
                                    <p>-</p>
                            @else
                                    <p>{{$blog->major}}</p>
                            @endif
                            </div>
                        </div>
                        <div class="panel-body">
                            @php
                                $id =  $blog->id;
                                $url = "site/users/$id/edit";
                            @endphp 
                            <div class="text-center">
                                <a class="btn btn-primary btn-lg" name="edit"  href="{{ url('site/home') }}">Back</a>  
                                <a class="btn btn-danger btn-lg" name="edit"  href="{{ url($url) }}">Edit</a>    
                            </div>                                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function edit(){
        var http = new XMLHttpRequest(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('demo').innerHTML = this.responseText;
            }
        };
        http.open("GET","home.blade.php",true);
        http.send();
    };
</script>
@endsection
