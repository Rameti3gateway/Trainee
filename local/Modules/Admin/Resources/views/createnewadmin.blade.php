@extends('site::layouts.app')

@section('content')
<div class="container register-form animated ZoomIn">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Admin</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id ?>/member/createnewadminprocess">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name<sup>*</sup></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('id_card') ? ' has-error' : '' }}">
                            <label for="id_card" class="col-md-4 control-label">ID Card<sup>*</sup></label>

                            <div class="col-md-6">
                                <input id="id_card" type="id_card" class="form-control" name="id_card" required>

                                @if ($errors->has('id_card'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_card') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address<sup>*</sup></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- gender -->
                        <div class="form-group">
                          <label for="gender" class="col-md-4 control-label">Gender<sup>*</sup></label>
                            <div class="col-md-6">
                                {{Form::select('gender', array('male' => 'Male', 'female' => 'Female'),['class'=>'selectpicker dropup'])}}
                            </div>
                          
                        </div>
                        <!-- birt date -->
                        <div class="form-group" >
                           <label for="birt_date" class="col-md-4 control-label">Birtday Date<sup>*</sup></label>
                            <div class="col-md-6">
                                {{Form::date('birt_date', \Carbon\Carbon::now(),['class'=>'form-control'])}}
                            </div>
                            
                        </div>
                       
                        <!--  -->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password<sup>*</sup></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password<sup>*</sup></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <!-- upload image -->
                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Upload Image<sup>*</sup></label>
                            <div class="col-md-6">
                                <input type="file" name="pro_image" />
                                <!-- {{Form::file('image', null)}} -->
                            </div>
                            
                        </div>
                        <!--  -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit"  class="btn btn-primary">
                                    Submit
                                </button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

