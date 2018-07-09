@extends('site::layouts.app')
@section('content')
<div class="container  animated zoomIn">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Your Profile</div>
                @php
                    $id=Auth::user()->id;
                    $url = "site/users/$id";
                @endphp
                 <form method="post" action="{{url($url)}}" enctype="multipart/form-data"> {{ csrf_field()}}                    
                      <div class="panel-body " style="text-align:center">
                        <h2>User Profile Card</h2>   

                        @if($profile->type == "facebook" || $profile->type == "google" )                                
                            @if(strstr($profile->image,'_',true) == 'user')
                                <img src="{{url('../assets/site/img/profile-image/user-image/'.$profile->image )}}" alt="photo" style="width:20%">
                            @else
                                <img src="{{$profile->image}}" alt="photo" style="width:20%">
                            @endif
                        @elseif($profile->type == 'general')
                            @if($profile->image == null)
                                <img src="{{ url('../assets/site/img/profile-image/default.jpg') }}" alt="photo" style="width:20%">
                            @else
                                <img src="{{url('../assets/site/img/profile-image/user-image/'.$profile->image )}}" alt="photo" style="width:20%">
                            @endif
                            
                        @endif                        
                       
                     </div>
                     <div class="panel-body ">
                        {{Form::label('null','Image :',['class'=>'col-md-4 control-label'])}}                      
                        <div class="col-md-6">
                            {{Form::file('image', null)}}                             
                        </div>
                    </div>
                    <div class="panel-body ">
                        {{Form::label('null','Name :',['class'=>'col-md-4 control-label'])}}                        
                        <div class="col-md-6">
                             {{Form::text('name', $profile->name,['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="panel-body ">
                         {{Form::label('null','ID Card :',['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                             {{Form::text('id_card', $profile->id_card ,['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        {{Form::label('null','Gender :',['class'=>'col-md-4 control-label'])}}                       
                        <div class="col-md-6">
                            {{Form::select('gender', array('male' => 'Male', 'female' => 'Female'), $profile->gender,['class'=>'form-control'])}}                             
                        </div>
                    </div>
                    <div class="panel-body" >
                        {{Form::label('null','Birtday Date :',['class'=>'col-md-4 control-label'])}}                      
                        <div class="col-md-6">
                            {{Form::date('birt_date', \Carbon\Carbon::now(),['class'=>'form-control'],$profile->birt_date)}}
                        </div>                            
                    </div>
                    <div class="panel-body">
                        {{Form::label('null','University:',['class'=>'col-md-4 control-label'])}}                        
                        <div class="col-md-6">
                             {{Form::text('university', $profile->university,['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        {{Form::label('null','Faculty:',['class'=>'col-md-4 control-label'])}}                         
                        <div class="col-md-6">
                             {{Form::text('faculty', $profile->faculty,['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        {{Form::label('null','Major :',['class'=>'col-md-4 control-label'])}}                      
                        <div class="col-md-6">
                             {{Form::text('major', $profile->major,['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="panel-body ">                        
                        {{Form::label('','',['class'=>'col-md-4 control-label'])}}    
                        <div class="col-md-6">
                            {{Form::submit('SUBMIT',['class'=>'btn btn-primary'])}}
                            @php                 
                                $id =  Auth::user()->id;
                                $urlcancel = "site/users/$id";                     
                             @endphp 
                             <a class="btn btn-danger" name="edit"  href="{{ url($urlcancel) }}">Cancel</a> 
                        </div>                       
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
