@extends('site::layouts.app')
{{ Html::style(('assets/site/css/admin/admin_member/editadmin.css')) }}    
@section('content')
<div class="container blog">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Admin Profile</div>
                @php
                    $id=Auth::user()->id;
                    $url = "admin/$id/member/$profile->id/editprocess";
                @endphp
                 <form method="post" enctype="multipart/form-data" action="{{url($url)}}">{{ csrf_field() }}
                    <div class="panel-body " style="text-align:center">
                        @php
                            $src = "../upload/img/site/admin-profile-image/$profile->image";
                        @endphp
                        <img src="{{url($src)}}" alt="photo" style="width:20%"> 
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
                             {{$errors->first('name')}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        {{Form::label('null','Email :',['class'=>'col-md-4 control-label'])}}                        
                        <div class="col-md-6">
                             {{Form::text('email', $profile->email,['class'=>'form-control'])}}
                             {{$errors->first('email')}}
                        </div>
                    </div>
                    <div class="panel-body ">
                         {{Form::label('null','ID Card :',['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                             {{Form::text('id_card', $profile->id_card ,['class'=>'form-control'])}}
                            
                             {{$errors->first('id_card')}}
                             
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
                            {{Form::date('birt_date', \Carbon\Carbon::parse($profile->birt_date, 'Asia/Bangkok'),['class'=>'form-control'])}}
                        </div>                            
                    </div>
                   
                    <div class="panel-body ">
                        
                        {{Form::label('','',['class'=>'col-md-4 control-label'])}}    
                        <div class="col-md-6">
                            {{Form::submit('SUBMIT',['class'=>'btn btn-primary'])}}
                            @php                 
                                $id =  Auth::user()->id;
                                $urlcancel = "admin/$id/member";                     
                             @endphp 
                             <a class="btn btn-danger" name="cancle"  href="{{ url($urlcancel) }}">Cancel</a> 
                        </div>                       
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
