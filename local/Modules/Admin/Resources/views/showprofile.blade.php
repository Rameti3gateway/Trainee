@extends('site::layouts.app')
<style>
    .container-fluid{
        margin-top: 1em;
    }
    .show-profile{
         animation-delay: 0.1s; 
    }
    .to-do-list{
         animation-delay: 0.1s;        
    }  
    .graph{
         animation-delay: 0.2s;
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- show profile -->
        <div class="col-md-6 col-md-offset-3 animated zoomIn show-profile">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Profile</strong></div>              
                <div class="panel-body ">
                    <label for="name" class="col-md-4 control-label">Name : </label>
                    <div class="col-md-6">
                        <?php if ($blog->name == null) { ?>
                        <p>-</p>
                        <?php } else { ?>
                        <p>{{$blog->name}}</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="panel-body">
                    <label for="email" class="col-md-4 control-label">Email Address : </label>
                    <div class="col-md-6">
                        <?php if ($blog->email == null) { ?>
                        <p>-</p>
                        <?php } else { ?>
                        <p>{{$blog->email}}</p>
                        <?php } ?>
                    </div>
                </div>
                <!-- <div class="panel-body">
                    <label for="id_card" class="col-md-4 control-label">ID Card : </label>
                    <div class="col-md-6">
                        <?php if ($blog->id_card == null) { ?>
                        <p>-</p>
                        <?php } else { ?>
                        <p>{{$blog->id_card}}</p>
                        <?php } ?>
                    </div>
                </div> -->
                <div class="panel-body">
                    <label for="gender" class="col-md-4 control-label">Gender : </label>
                    <div class="col-md-6">
                        <?php if ($blog->gender == null) { ?>
                        <p>-</p>
                        <?php } else { ?>
                        <p>{{$blog->gender}}</p>
                        <?php } ?>
                    </div>
                </div>
                         
            </div>    
        </div>

        <!-- To do list -->
        <div class="col-md-6 col-md-offset-3 animated fadeInUp To-do-list">
            <div  id="displaytask">
                <div class="panel panel-default">                    
                    <div class="panel-body">
                        <div class="panel-heading">
                            <strong>To do list</strong> 
                           
                            {{ Form::select('date',$choosedate, null , ['class' => 'form-control','id'=>'selectdate']) }}</div>
                        <table class="table table-striped task-table">
                            <tbody id="choosedate" >
                                <script type="text/javascript">
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                        }
                                    });
                                    $(function($){
                                        $("#selectdate").change(function(){
                                            if($("#selectdate").val() != 0){
                                                $.ajax({
                                                    'type':'post',
                                                    'url' : "http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id; ?>/showprofile/<?php echo $blog->id ?>/showtodolist",
                                                    'cache':false,
                                                    'data':{date:$("#selectdate").val()},
                                                    'success':function(data){
                                                    $("#choosedate").empty();
                                                    $.each(data.tasks,function(index,value){
                                                        $("#choosedate").append("<tr class='text-center'><td>"+(index+1)+"</td><td>"+value.detail+"</td></tr>");

                                                    });
                                                    
                                                    },
                                                })
                                            }else{
                                                $("#choosedate").empty();
                                            }
                                        
                                        })

                                    })
                                </script>
                            </tbody>
                        </table> 
                    </div> 
                </div>
            </div>
        </div>

        <!-- graph -->
        <div class="col-md-6 col-md-offset-3 graph animated fadeInUp">
            <div class="panel panel-default">
                <div class="panel-body">
                     <div class="panel-heading"><strong>Checkin & Checkout Graph</strong> 
                    {{ Form::select('date',array(''=>'Please Select','week'=>'Week','month'=>'Month'), null , ['class' => 'form-control','id'=>'selectweekormonth']) }}
                        <div id="divweekormonth">
                            {{ Form::select('date',array(''=>'Select'), null , ['class' => 'form-control','id'=>'formweekormonth']) }}
                        </div>
                    <canvas  id="showgraph"></canvas >                    
                                     
                        <script>
                            $("#divweekormonth").hide();
                            $("#showgraph").hide();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                }
                            });
                            $(function($){
                                function epoch_to_hh_mm_ss(epoch) {
                                    return new Date(epoch*1000).toISOString().substr(12, 7)
                                }
                                $("#selectweekormonth").change(function(){
                                    if($("#selectweekormonth").val() == ''){
                                        $("#divweekormonth").hide();
                                        $("#showgraph").hide();
                                    }else{
                                        $("#divweekormonth").show();
                                        $.ajax({
                                            'type':'post',
                                            'url':"http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id; ?>/showprofile/<?php echo $blog->id ?>/selectweekormonth",
                                            'cache':false,
                                            'data':{data:$("#selectweekormonth").val()},
                                            'success':function(data){
                                                $("#formweekormonth").empty();
                                                $("#formweekormonth").prepend("<option value=''>Select</option>")
                                                $.each(data.data,function(index,value){
                                                    
                                                    $("#formweekormonth").append("<option value='"+index+"'>"+value+"</option>");
                                                })
                                            }
                                        })
                                    }
                                })
                                $("#formweekormonth").change(function(){
                                    if($("#formweekormonth").val() != '' ){
                                        $("#showgraph").show();
                                        var date = $("#formweekormonth").val();
                                        var url = "http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id; ?>/showprofile/<?php echo $blog->id ?>/showgraph/"+date;
                                        console.log(url);
                                        $.ajax({
                                            'type':'get',
                                            'url':url,
                                            'cache':false,
                                            'data':{data:$("#formweekormonth").val()},
                                            'success':function(response){    
                                               
                                                var timechin = response.timechin;
                                                var timechout = response.timechout;
                                                var date = response.date;
                                                
                                              
                                                var ctx = document.getElementById("showgraph").getContext("2d");
                                                var chart = new Chart(ctx, {
                                                    type: "line",
                                                    data: {
                                                        datasets: [
                                                            {
                                                                y: moment("00:00:05", "HH:mm:ss"),
                                                                x: "Phase 1",
                                                                data: {
                                                                title: "Phase 1",
                                                                pass: false
                                                                }
                                                            },
                                                            {
                                                                y: moment("00:00:22", "HH:mm:ss"),
                                                                x: "Phase 2",
                                                                data: {
                                                                title: "Phase 2",
                                                                pass: false
                                                                }
                                                            },

                                                        ]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        unitStepSize: 10,
                                                       
                                                        showLines:false,
                                                        title: {
                                                        display: true,
                                                        text: "Chart Time Check in & Check out"
                                                        },
                                                        scales: {
                                                        yAxes: [
                                                            {
                                                            type: "time",
                                                            display: true,
                                                            scaleLabel: {
                                                                display: true,
                                                                labelString: "Time"
                                                            },
                                                            time: {
                                                                unit: "second"
                                                            },
                                                                        displayFormats: {
                                                                            quarter: 'h:mm:ss a'
                                                                        },
                                                            ticks: {
                                                                major: {
                                                                fontStyle: "bold",
                                                                fontColor: "#FF0000"
                                                                }
                                                            }
                                                            }
                                                        ],
                                                        xAxes: [
                                                            {
                                                            display: true,
                                                            scaleLabel: {
                                                                display: true,
                                                                labelString: "Date"
                                                            }
                                                            }
                                                        ]
                                                        }
                                                    }
                                                })
                                                // var mychart = new Chart(ctx,{
                                                //     type: 'line',
                                                   
                                                //     data: {
                                                //         labels: response.date,
                                                //         datasets: [{
                                                //             label: 'Time Checkin',
                                                //             data: response.timechin,
                                                //             fill: false,
                                                //             backgroundColor: 'rgb(255,0,0)',
                                                //             pointRadius:5,
                                                //             pointBackgroundColor:'rgb(255,0,0)',
                                                //         },{
                                                //             label: 'Time Checkout',
                                                //             data:response.timechout,
                                                //             fill: false,
                                                //             backgroundColor: 'rgb(0,0,255)',
                                                //             pointRadius:5,
                                                //             pointBackgroundColor:'rgb(0,0,255)',
                                                           
                                                //         }]
                                                //     },
                                                //     options: {
                                                //         showLines:false,
                                                //         scales: {
                                                //             type: 'time',
                                                //             time: {
                                                //                 displayFormats: {
                                                //                     quarter: 'h:mm:ss a'
                                                //                 }
                                                //             }
                                                //         },
                                                       
                                                //     },
                                                    
                                                // });                           
                                            }

                                            
                                        })

                                    }else{
                                        $("#showgraph").hide();
                                    }                       
                                })
                            }) 
                        </script>                    
                    </div> 
                </div>
                              
            </div>
            <div class="panel-body">
                <?php
                    $id =  Auth::user()->id ;
                    $url = "admin/$id/dashboard";
                ?>
                <div class="text-center">
                    <a class="btn btn-primary btn-lg" name="edit"  href="{{ url($url) }}">Back</a>  
                </div>  
                                                 
            </div>
        </div>
    </div>
</div>
@endsection
