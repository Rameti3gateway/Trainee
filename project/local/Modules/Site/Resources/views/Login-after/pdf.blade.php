@extends('site::layouts.app')
{{ Html::style(('assets/site/css/login-after/pdf.css')) }}
@section('content')
@php                 
    $id =  Auth::user()->id;
    $url = "site/users/$id/report/checkincheckout";   
    $url2 = "site/users/$id/report/todolist";                     
@endphp 

<div class="container animated fadeIn">
    <div class="row generate">
        <div class="col">
            <h1>Generate Report</h1> 
        </div>  
    </div>      
    <div class="row text-center"> 
        <div class="col-lg-4 col-lg-offset-2">  
             {{ Form::label('','Checkin&Checkout Report') }} 
            <div id="selecttor">
                {{ Form::select('size', ['year' => 'Year', 'month' => 'Month','interval'=>'Interval'], null, ['placeholder' => 'Choose','class'=>'form-control','id'=>'selecttoryearmonthinterval']) }}
            </div>
            <div id="selectyearmonth">
                {{ Form::select('size', [], null, ['placeholder' => 'Choose','class'=>'form-control','id'=>'selecttoryearmonth']) }}
            </div>   
            <div id="selectinterval">
                {{ Form::select('size', [], null, ['placeholder' => 'Choose','class'=>'form-control','id'=>'selecttorinterval1']) }}to{{ Form::select('size', [], null, ['placeholder' => 'Choose','class'=>'form-control','id'=>'selecttorinterval2']) }}
            </div>   
            <button class="btn btn-default btn-lg" id="chooseforcheckincheckout">
                <span class="glyphicon glyphicon-circle-arrow-down"></span> Download
            </button>          
        </div>             
        <div class="col-lg-4">    
             {{ Form::label('','Todolist Report') }}
            @php
                use Carbon\carbon;
                echo "<select class='form-control' id='selecttodolist'>";
                    echo "<option>Choose</option>";
                    foreach ($data as $key => $value) {
                        $val = Carbon::parse($value)->format("F Y");
                        echo "<option id=$value >$val</option>";
                    }
                echo "</select>";
            @endphp
            <button class="btn btn-default btn-lg" id="choosefortodolist">
                <span class="glyphicon glyphicon-circle-arrow-down"></span> Download
            </button>            
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
                            'url':'report/checkincheckout/choose',
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
                                'url':'report/checkincheckout/choose',
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
                        // var link = $(this).attr('http://localhost/trainee/site/users/2/report');
                        var type = $("#selecttoryearmonthinterval").val();
                        var detail = $("#selecttoryearmonth").val();
                        var detail1 = $("#selecttorinterval1").val();
                        var detail2 = $("#selecttorinterval2").val();                        
                        if(type == "interval"){
                            if($("#selecttorinterval1")[0].selectedIndex != 0 && $("#selecttorinterval2")[0].selectedIndex != 0){
                                var url = "{{url('report/checkincheckout/month')}}";
                                <?php $userid = Auth::user()->id; ?>
                                 // var url = "http://localhost/trainee/site/users/<?php echo Auth::user()->id; ?>/report/checkincheckout/"+type+"/"+detail1+"/"+detail2;
                                var htmlString = '<html>';
                                htmlString += '<a href="{{url("site/users/$userid/report/checkincheckout/")}}'+'/'+type+'/'+detail1+'/'+detail2+'" >Click here to Download</a>';
                                htmlString += '</html>';
                                console.log(htmlString);
                                swal({   
                                    title: 'Your Generate PDF Checkin Checkout',
                                    confirmButtonText: 'OK',
                                    html:htmlString,
                                })
                            }else{
                                var x = document.getElementById("selecttorinterval2").length;
                                var y = document.getElementById("selecttorinterval1").length;
                                if(y != 1 && x == 1){
                                    if($("#selecttorinterval1")[0].selectedIndex != 0){
                                       
                                        <?php $userid = Auth::user()->id; ?>
                                        var htmlString = '<html>';
                                        htmlString += '<a href="{{url("site/users/$userid/report/checkincheckout/month/")}}'+'/'+detail1+'" >Click here to Download</a>';
                                        htmlString += '</html>';
                                        console.log(htmlString);
                                        swal({   
                                            title: 'Your Generate PDF Checkin Checkout',
                                            confirmButtonText: 'OK',
                                            html:htmlString,
                                        })
                                    }else{
                                        swal({   
                                            'title':'Please Choose',
                                           
                                        })
                                    }
                                    
                                }else{
                                    if(x==1 && y==1){
                                        swal({
                                            'title':'No data',                           
                                        })

                                    }else{
                                        swal({
                                            'title':'Please Choose',                           
                                        })
                                    }
                                   
                                }
                                
                            }                        
                        }else if(type=="year" || type=="month"){
                            var x = document.getElementById("selecttoryearmonth").length;
                            console.log(detail);
                            if($("#selecttoryearmonth")[0].selectedIndex != 0){
                                
                                <?php $userid = Auth::user()->id; ?>
                                
                                var htmlString = '<html>';
                                htmlString += '<a href="{{url("site/users/$userid/report/checkincheckout/")}}'+'/'+type+'/'+detail+'" >Click here to Download</a>';
                                htmlString += '</html>';
                                console.log(htmlString);
                                swal({   
                                    title: 'Your Generate PDF Checkin Checkout',
                                    confirmButtonText: 'OK',
                                    html:htmlString,
                                })
                            }else{
                                if(x==1){
                                    swal({
                                        'title':'No Data'

                                    })
                                }else{
                                    swal({
                                        'title':'Please choose '+type+' before'

                                    })
                                }

                                
                            }                            
                        }else if(type = "Choose"){
                            swal({   
                                title: 'Please Choose Before',
                                confirmButtonText: 'OK',
                                    
                            })
                        }                        
                    })
                    $("#choosefortodolist").click(function(){
                        var data = $("#selecttodolist").val();
                        <?php $userid = Auth::user()->id; ?>
                        var htmlString = '<html>';
                        htmlString += '<a href="{{url("site/users/$userid/report/todolist/")}}'+'/'+data+'" >Click here to Download</a>';
                        htmlString += '</html>';
                        console.log(htmlString);
                        console.log(data);
                        if(data != 'Choose'){
                            swal({   
                                title: 'Your Generate PDF Todolist',
                                confirmButtonText: 'OK',
                                html:htmlString,
                            })
                        }else{
                            swal({   
                                title: 'Please Choose Before',
                                confirmButtonText: 'OK',
                                
                            })
                        }
                        
                    })                    
                })
         </script>
    </div>  
</div> 
@endsection
