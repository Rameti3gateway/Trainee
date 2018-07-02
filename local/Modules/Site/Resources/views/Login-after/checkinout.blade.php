@extends('site::layouts.app')
    @if(isset($style))
        @foreach($style as $css)
                {{ Html::style(( $css ))}}
        @endforeach
    @endif
@section('content')
    <div class="container text-center checkinout-main animated zoomIn">
        <h1 class="text-center text-success checkinout">CheckIN-CheckOut</h1>
        <h3><a href="{{url('site/home')}}">Back To Home</a></h3>
        <div class="row">
        <div class="col-lg-6" >
                {{Form::submit('CheckIn',['class'=>'btn btn-primary btn-circle btn-xl','name'=>'check_in','id'=>'check_in'])}}
        </div>
        <div class="col-lg-6">
                {{Form::submit('CheckOut',['class'=>'btn btn-danger btn-circle btn-xl','name'=>'check_out','id'=>'check_out'])}}
        </div>
        </div>
    </div>
	<script type="text/javascript">
		$(function($){
         $("#check_in").click(function(){
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });               
            $.ajax({
                'method':'post',
                'url': 'http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/checkinout/check',
                'data':{data: $("#check_in").val()},
                'success': function(data){                	
                   alert(data) ;            
                }
            });
       });        
     });
        $(function($){
             $("#check_out").click(function(){
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                'method':'post',
                'url': 'http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/checkinout/check',
                'data':{data: $("#check_out").val()},
                'success':function(data){
                    alert(data) ;           
                }
             });
         });
        });
    </script>    
@endsection
