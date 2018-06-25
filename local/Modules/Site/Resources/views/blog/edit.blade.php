@extends('site::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your Profile</div>
                @php
                    $id=Auth::user()->id;
                    $url = "site/users/$id";
                @endphp
                 <form method="post" action="{{url($url)}}">{{ csrf_field() }}
        
                    <div class="panel-body ">
                        <label for="name" class="col-md-2 control-label">Name : </label>
                        <div class="col-md-6">
                             {{Form::text('name', $profile->name)}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        <label for="name" class="col-md-2 control-label">ID Card : </label>
                        <div class="col-md-6">
                             {{Form::text('id_card', $profile->id_card)}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        <label for="name" class="col-md-2 control-label">Gender : </label>
                        <div class="col-md-6">
                            {{Form::select('gender', array('male' => 'Male', 'female' => 'Female'), $profile->gender)}}
                             
                        </div>
                    </div>
                    <div class="form-group" >
                       <label for="birt_date" class="col-md-4 control-label">Birtday Date</label>
                        <div class="col-md-6">
                            {{Form::date('birt_date', \Carbon\Carbon::now(),['class'=>'form-control'],$profile->birt_date)}}
                        </div>
                            
                    </div>
                    <div class="panel-body ">
                        <label for="name" class="col-md-2 control-label">University: </label>
                        <div class="col-md-6">
                             {{Form::text('university', $profile->university)}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        <label for="name" class="col-md-2 control-label">Faculty: </label>
                        <div class="col-md-6">
                             {{Form::text('faculty', $profile->faculty)}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        <label for="name" class="col-md-2 control-label">Major : </label>
                        <div class="col-md-6">
                             {{Form::text('major', $profile->major)}}
                        </div>
                    </div>
                    <div class="panel-body ">
                        {{Form::submit('SUBMIT')}}
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
