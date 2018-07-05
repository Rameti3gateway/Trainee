@extends('site::layouts.app')
<style>
   
</style>
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
            <div id="selectyearmonth">{{ Form::select('size', [], null, ['placeholder' => 'Choose','class'=>'form-control','id'=>'selecttoryearmonth']) }}</div>   
            
            <div id="selectinterval">{{ Form::select('size', [], null, ['placeholder' => 'Choose','class'=>'form-control','id'=>'selecttorinterval1']) }}to{{ Form::select('size', [], null, ['placeholder' => 'Choose','class'=>'form-control','id'=>'selecttorinterval2']) }}</div>   
            <a ><button class="btn btn-primary mt-5" id="chooseforcheckincheckout">Checkin&Checkout Report</button> </a>
        </div>      
       
        <div class="col-lg-6">   
            <!-- {{ Form::select('size', $data, null, ['placeholder' => 'choose','class'=>'form-control','id'=>'selecttodolist']) }} -->
            <?php
            use Carbon\carbon;
            echo "<select class='form-control' id='selecttodolist'>";
                foreach ($data as $key => $value) {
                    $val = Carbon::parse($value)->format("F Y");
                    echo "<option id=$value >$val</option>";
                }
            echo "</select>";
            ?>
             <a><button class="btn btn-primary mt-5" id="choosefortodolist">Todolist Report</button> </a>
         </div>
         <script>
               
                
               
                $("#selectyearmonth").hide();
                $("#selectinterval").hide();
                $(function($){
                    
                    $("#selecttoryearmonthinterval").change(function(){   
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });     
                        if($("#selecttoryearmonthinterval").val() == "year" || $("#selecttoryearmonthinterval").val() == "month"){
                            $("#selectyearmonth").show();
                          
                            $("#selectinterval").hide();
                            
                        }else if($("#selecttoryearmonthinterval").val() == "interval"){
                            $("#selectinterval").show();
                            $("#selectyearmonth").hide();
                           
                        }else{
                            $("#selectyearmonth").hide();
                            $("#selectinterval").hide();
                        }
                        $.ajax({
                            'type':'post',
                            'url':'http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/report/checkincheckout/choose',
                            'data':{data:$("#selecttoryearmonthinterval").val()},
                            'cache':false,
                            'success':function(response){
                                $("#selecttoryearmonth").empty();
                                $("#selecttorinterval1").empty();
                                $("#selecttorinterval2").empty();
                                $("#selecttorinterval1").append("<option>Choose</option>");
                                $("#selecttorinterval2").append("<option>Choose</option>");
                                $("#selecttoryearmonth").append("<option>Choose</option>");
                               
                                function leftPad(number, targetLength) {
                                    var output = number + '';
                                    while (output.length < targetLength) {
                                        output = '0' + output;
                                    }
                                    return output;
                                }
                                $.each(response.data,function(index,value){
                                    var d = new Date(value);
                                    var y = d.getFullYear();
                                    var n = d.getMonth();
                                    $("#selecttoryearmonth").append("<option id='"+y+"-"+leftPad(n,2)+"'>"+value+"</option>");
                                    $("#selecttorinterval1").append("<option id='"+index+"'>"+value+"</option>");
                                    // $("#selecttorinterval2").append("<option id='"+index+"'>"+value+"</option>");
                                   
                                });
                                
                            }
                        })

                    })
                    $("#selecttorinterval1").change(function(){
                        if($("#selecttorinterval1")[0].selectedIndex == 0){
                            $("#selecttorinterval2").empty();
                            $("#selecttorinterval2").append("<option>Choose</option>");
                        }else{
                            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                            });     
                            $.ajax({
                                'type':'post',
                                'url':'http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/report/checkincheckout/choose',
                                'data':{data:$("#selecttoryearmonthinterval").val()},
                                'cache':false,
                                'success':function(response){
                                    $("#selecttorinterval2").empty();
                                    $("#selecttorinterval2").append("<option>Choose</option>");
                                    console.log(response.data);
                                    function leftPad(number, targetLength) {
                                        var output = number + '';
                                        while (output.length < targetLength) {
                                            output = '0' + output;
                                        }
                                        return output;
                                    }
                                    $.each(response.data,function(index,value){
                                        console.log( $("#selecttorinterval1")[0].selectedIndex);
                                        if(index >=  $("#selecttorinterval1")[0].selectedIndex){
                                            $("#selecttorinterval2").append("<option id='"+index+"'>"+value+"</option>");
                                        }
                                        
                                    });                                        
                                }
                            })

                        }       
                        
                                
                    })
                    $("#chooseforcheckincheckout").click(function(){
                        
                        // var link = $(this).attr('http://localhost/Laravel/Trainee/local/site/users/2/report');

                        var type = $("#selecttoryearmonthinterval").val();
                        var detail = $("#selecttoryearmonth").val();

                        var detail1 = $("#selecttorinterval1").val();
                        var detail2 = $("#selecttorinterval2").val();
                        

                        if(type == "interval"){
                            if($("#selecttorinterval1")[0].selectedIndex != 0 && $("#selecttorinterval2")[0].selectedIndex != 0){
                                var url = "http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/report/checkincheckout/"+type+"/"+detail1+"/"+detail2;
                                var htmlString = '<html>';
                                htmlString += '<a href="'+url+'" >Click here to Download</a>';
                                htmlString += '</html>';
                                console.log(htmlString);
                                swal({   
                                    title: 'Your Generate PDF Checkin Checkout',
                                    confirmButtonText: 'OK',
                                    html:htmlString,
                                })
                            }else{
                                swal({
                                    'title':'Please Choose Start Or End Before'

                                })
                            }
                        
                        }else if(type=="year" || type=="month"){
                            if($("#selecttoryearmonth")[0].selectedIndex != 0){
                                var url = "http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/report/checkincheckout/"+type+"/"+detail;
                                var htmlString = '<html>';
                                htmlString += '<a href="'+url+'" >Click here to Download</a>';
                                htmlString += '</html>';
                                console.log(htmlString);
                                swal({   
                                    title: 'Your Generate PDF Checkin Checkout',
                                    confirmButtonText: 'OK',
                                    html:htmlString,
                                })
                            }else{
                                swal({
                                    'title':'Please choose '+type+' before'

                                })
                            }
                            
                        }
                        
                    })
                    $("#choosefortodolist").click(function(){
                        var data = $("#selecttodolist").val();
                        var url = "http://localhost/Laravel/Trainee/local/site/users/<?php echo Auth::user()->id; ?>/report/todolist/"+data;
                        var htmlString = '<html>';
                        htmlString += '<a href="'+url+'" >Click here to Download</a>';
                        htmlString += '</html>';
                        console.log(htmlString);
                        swal({   
                            title: 'Your Generate PDF Todolist',
                            confirmButtonText: 'OK',
                            html:htmlString,
                        })

                    })
                    
                })
         </script>
    </div>  
</div> 


@endsection
