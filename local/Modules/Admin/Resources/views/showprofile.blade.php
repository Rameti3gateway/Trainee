@extends('site::layouts.app')
 {{ Html::style(('../assets/site/css/Admin/dashboard/showprofile.css')) }}
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- show profile -->
        <div class="col-md-6 col-md-offset-3 show-profile">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Profile</strong></div>  
                <div class="panel-body text-center">
                    @if($blog->type == "facebook" || $blog->type == "google" )                                
                        @if(strstr($blog->image,'_',true) == 'user')
                            <img class="hvr-grow" src="{{url('../upload/img/site/profile-image/'.$blog->image )}}" alt="photo" style="width:20%">
                        @else
                            <img class="hvr-grow" src="{{$blog->image}}" alt="photo" style="width:20%">
                        @endif
                    @elseif($blog->type == 'general')
                        @if($blog->image == null)
                            <img class="hvr-grow" src="{{ url('../upload/img/default.jpg') }}" alt="photo" style="width:20%">
                        @else
                            <img class="hvr-grow" src="{{url('../upload/img/site/profile-image/'.$blog->image )}}" alt="photo" style="width:20%">
                        @endif                            
                    @endif                        
                 </div>     
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
        <div class="col-md-6 col-md-offset-3 animated fadeIn To-do-list">
            <div  id="displaytask">
                <div class="panel panel-default">                    
                    <div class="panel-body">
                        <div class="panel-heading">
                            <strong>To do list</strong>                            
                            {{ Form::select('date',$choosedate, null , ['class' => 'form-control','id'=>'selectdate']) }}
                        </div>
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
        <div class="col-md-6 col-md-offset-3 graph animated fadeIn">
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
                                        
                                        $("#showgraph").empty();
                                        var date = $("#formweekormonth").val();
                                        var url = "http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id; ?>/showprofile/<?php echo $blog->id ?>/showgraph/"+date;
                                        console.log(url);
                                        $.ajax({
                                            'type':'get',
                                            'url':url,
                                            'cache':false,
                                            'data':{data:$("#formweekormonth").val()},
                                            'success':function(response){
                                                $("#showgraph").show();
                                                var timechin = response.timechin;
                                                var timechout = response.timechout;
                                                var date = response.date;
                                                

                                               
                                                

                                               


                                                var ctx = document.getElementById("showgraph").getContext("2d");
                                        
                                                let years = date;
                                                console.log(response.test);
                                                // let times = ["11:46:07", "11:41:14", "11:55:26", "12:14:58", "11:54:55", "11:54:04", "12:28:29", "12:35:18"];
                                                console.log(timechin);
                                                console.log(timechout);
                                                console.log(date);
                                                
                                                let data = years.map((year, index) => (
                                                    {
                                                        x: moment(`${year}`), 
                                                        y: moment(`1970-02-01 ${timechin[index]}`).valueOf()
                                                    } 
                                                ));
                                                let data1 = years.map((year, index) => (     
                                                    {
                                                        x: moment(`${year}`), 
                                                        y: moment(`1970-02-01 ${timechout[index]}`).valueOf()
                                                    } 
                                                ));
                                                
                                                
                                                let bckColors = ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#565452", "#321456", "#129864", "#326812", "#215984"];
                                                
                                                let myChart = new Chart(ctx, {
                                                    type: 'line',
                                                    data: {
                                                        datasets: [
                                                            {
                                                                label: "Check in",
                                                                backgroundColor: '#3e95cd',
                                                                pointBackgroundColor: '#3e95cd',
                                                                data: data,
                                                                pointBorderWidth: 2,
                                                                pointRadius: 5,
                                                                pointHoverRadius: 7,
                                                                fill: false,
                                                                showLine:false
                                                            },
                                                            {
                                                                label: "Check out",
                                                                backgroundColor: '#8e5ea2',
                                                                pointBackgroundColor: '#8e5ea2',
                                                                data: data1,
                                                                pointBorderWidth: 2,
                                                                pointRadius: 5,
                                                                pointHoverRadius: 7,
                                                                fill: false,
                                                                showLine:false
                                                            }

                                                        ]
                                                        
                                                    },
                                                    options: {
                                                        tooltips: {
                                                            enabled: false
                                                        },
                                                        scales: {
                                                            xAxes: [
                                                            {
                                                                type: 'time',
                                                                display: true,
                                                                scaleLabel: {
                                                                    display: true,
                                                                    labelString: "Date"
                                                                },
                                                                
                                                                position: 'bottom',
                                                                time: {
                                                                    unit: 'day',
                                                                    unitStepSize: 0.5,
                                                                    round: 'day',
                                                                   
                                                                    displayFormats: {
                                                                        day: 'D MMM Y '
                                                                    }
                                                                }
                                                                
                                                                
                                                            }
                                                            ],
                                                            yAxes: [
                                                            {
                                                                type: 'linear',
                                                                position: 'left',
                                                                ticks: {
                                                                    min: moment('1970-02-01 08:00:00').valueOf(),
                                                                    max: moment('1970-02-01 23:59:59').valueOf(),
                                                                    stepSize: 3.6e+6,
                                                                    beginAtZero: false,
                                                                    
                                                                    callback: value => {
                                                                        let date = moment(value);
                                                                        if(date.diff(moment('1970-02-01 23:59:59'), 'minutes') === 0) {
                                                                        return null;
                                                                        }
                                                                        
                                                                        return date.format('h:mm A');
                                                                    },
                                                                    
                                                                }
                                                            }
                                                            ]
                                                        }
                                                    }
                                                });

                                                // var speedData = {
                                                // labels: [10],
                                                // datasets: [{
                                                //     label: "Car Speed",
                                                //     data: showtimechin,
                                                //     lineTension: 0.25,
                                                //     fill: false,
                                                //     borderColor: 'orange',
                                                //     backgroundColor: 'transparent',
                                                //     pointBorderColor: 'orange',
                                                //     pointBackgroundColor: 'rgba(255,150,0,0.5)',
                                                //     borderDash: [5, 5],
                                                //     pointRadius: 5,
                                                //     pointHoverRadius: 10,
                                                //     pointHitRadius: 30,
                                                //     pointBorderWidth: 2,
                                                //     pointStyle: 'rectRounded'
                                                // }]
                                                // };

                                                // var chartOptions = {
                                                // legend: {
                                                //     display: true,
                                                //     position: 'top',
                                                //     labels: {
                                                //     boxWidth: 80,
                                                //     fontColor: 'black'
                                                //     }
                                                // },
                                                // scales: {
                                                //     yAxes: [{
                                                //         type: "time",
                                                //         time: {
                                                //             unit: 'hour',
                                                //             unitStepSize: 0.5,
                                                //             round: 'hour',
                                                //             tooltipFormat: "h:mm:ss a",
                                                //             displayFormats: {
                                                //             hour: 'MMM D, h:mm A'
                                                //             }
                                                //         },
                                                //         scaleLabel: {
                                                //             display: true,
                                                            
                                                //         }
                                                //     }],
                                                //     // xAxes: [{
                                                //     // gridLines: {
                                                //     //     color: "black",
                                                //     //     borderDash: [2, 5],
                                                //     // },
                                                //     // scaleLabel: {
                                                //     //     display: true,
                                                //     //     labelString: "Speed in Miles per Hour",
                                                //     //     fontColor: "green"
                                                //     // }
                                                //     // }]
                                                // }
                                                // };

                                                // var lineChart = new Chart(ctx, {
                                                // type: 'line',
                                                // data: speedData,
                                                // options: chartOptions
                                                // });     
                                            }

                                                // var chart = new Chart(ctx, {
                                                //     type: "line",
                                                //     data: {
                                                //         datasets: [
                                                //             {
                                                //                 y: moment("00:00:05", "HH:mm:ss"),
                                                //                 x: "Phase 1",
                                                //                 data: {
                                                //                 title: "Phase 1",
                                                //                 pass: false
                                                //                 }
                                                //             },
                                                //             {
                                                //                 y: moment("00:00:22", "HH:mm:ss"),
                                                //                 x: "Phase 2",
                                                //                 data: {
                                                //                 title: "Phase 2",
                                                //                 pass: false
                                                //                 }
                                                //             },

                                                //         ]
                                                //     },
                                                //     options: {
                                                //         responsive: true,
                                                //         unitStepSize: 10,
                                                       
                                                //         showLines:false,
                                                //         title: {
                                                //         display: true,
                                                //         text: "Chart Time Check in & Check out"
                                                //         },
                                                //         scales: {
                                                //         yAxes: [
                                                //             {
                                                //             type: "time",
                                                //             display: true,
                                                //             scaleLabel: {
                                                //                 display: true,
                                                //                 labelString: "Time"
                                                //             },
                                                //             time: {
                                                //                 unit: "second"
                                                //             },
                                                //             displayFormats: {
                                                //                 quarter: 'h:mm:ss a'
                                                //             },
                                                //             ticks: {
                                                //                 major: {
                                                //                     fontStyle: "bold",
                                                //                     fontColor: "#FF0000"
                                                //                 }
                                                //             }
                                                //             }
                                                //         ],
                                                //         xAxes: [
                                                //             {
                                                //             display: true,
                                                //             scaleLabel: {
                                                //                 display: true,
                                                //                 labelString: "Date"
                                                //             }
                                                //             }
                                                //         ]
                                                //         }
                                                //     }
                                                // })
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
                                            // }

                                            
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
                    <a href="{{ url($url) }}">
                        <button type="button" class="text-center col-lg-4 col-lg-offset-4 btn btn-primary hvr-icon-back">
                            <i class="glyphicon glyphicon-menu-left hvr-icon"></i>
                            Back
                        </button>
                    </a> 
                </div>                        
            </div>
        </div>
    </div>
</div>
@endsection
