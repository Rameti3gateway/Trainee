@extends('site::layouts.app')
@section('content')
@php                 
    $id =  Auth::user()->id;
    $url = "site/users/$id/report/checkincheckout";   
    $url2 = "site/users/$id/report/todolist";                     
@endphp 
<div class="container">
    <div class="row text-center mt-5 mb-5">
        <div class="col">
            <h1>Generate Report</h1> 
        </div>  
    </div>      
    <div class="row text-center"> 
        <div class="col-lg-6 ">                             
           
            <div id="selecttor">{{ Form::select('size', ['year' => 'Year', 'month' => 'Month','interval'=>'Interval'], null, ['placeholder' => 'Choose','class'=>'form-control','id'=>'selecttoryearmonthinterval']) }}</div>
            <div id="selectyear">{{ Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Year','class'=>'form-control','id'=>'selecttoryear']) }}</div>   
            <div id="selectmonth">{{ Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Year','class'=>'form-control','id'=>'selecttorrmonth']) }}</div>   
            <div id="selectinterval">{{ Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Year','class'=>'form-control','id'=>'selecttorinterval']) }}</div>       
            <a><button class="btn btn-primary mt-5" id="chooseforcheckincheckout">Checkin&Checkout Report</button> </a>
        </div>      
        <div class="col-lg-6">   
            {{ Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Month','class'=>'form-control','id'=>'selecttodolist']) }}
             <a><button class="btn btn-primary mt-5" id="choosefortodolist">Todolist Report</button> </a>
         </div>
         <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });     
                // $("#selecttor").hide();
                $("#selectyear").hide();
                $("#selectmonth").hide();
                $("#selectinterval").hide();
                $(function($){
                    $("#selecttoryearmonthinterval").change(function(){   
                        if($("#selecttoryearmonthinterval").val() == "year"){
                            $("#selectyear").show();
                            $("#selectmonth").hide();
                            $("#selectinterval").hide();
                        }else if($("#selecttoryearmonthinterval").val() == "month"){
                            $("#selectmonth").show();
                            $("#selectyear").hide();
                            $("#selectinterval").hide();
                        }else if($("#selecttoryearmonthinterval").val() == "intervel"){
                            $("#selectinterval").show();
                            $("#selectyear").hide();
                            $("#selectmonth").hide();
                        }

                    })
                    
                })
         </script>
    </div>  
</div> 


@endsection
