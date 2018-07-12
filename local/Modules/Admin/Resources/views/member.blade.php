@extends('site::layouts.app')
 {{ Html::style(('../assets/site/css/Admin/admin_member/member.css')) }}
@section('content')
  <!-- This view is loaded from module: {!! config('admin.name') !!} -->
    <div class="container-fluid animated fadeIn">
        <div class="row list-member">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1><strong>Admin Member</strong></h1></div>              
                        <div class="panel-body ">
                            <table class="table ">
                                <tbody>
                                    <div class="col-lg-2 text-center">
                                        No.
                                    </div>
                                    <div class="col-lg-6 text-center">
                                        <div>Name</div>
                                    </div>
                                    @foreach ($member as $member)
                                    <tr id="admin-{{$member->id}}">
                                        <td class="col-xs-2 text-center">
                                             <p> {{$member->user_id}} </p>
                                        </td>
                                        <td class="col-xs-6 text-center">
                                            <p> {{$member->name}} </p>
                                        </td>
                                        <td class="col-xs-1">
                                            <form action= "http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id ?>/member/{{$member->user_id}}/editadmin" method="get">
                                                <button type="submit" class="btn btn-warning hvr-icon-grow" >
                                                     <i class="glyphicon glyphicon-edit hvr-icon"></i></i>
                                                    Edit
                                                </button>
                                            </form>
                                        </td>
                                        <td class="col-xs-3">                                          
                                           
                                            <!-- Trigger the modal with a button -->
                                            <button type="button" class="btn btn-danger hvr-icon-grow" id="deletebutton-{{$member->user_id}}">
                                                 <i class="glyphicon glyphicon-minus hvr-icon"></i></i>
                                                Delete
                                            </button>
                                            <script>
                                                $(function($){
                                                     $.ajaxSetup({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                        }
                                                    });                                                    
                                                    $("#deletebutton-{{$member->user_id}}").click(function(){
                                                        alert
                                                        swal({
                                                            title: 'Are you sure delete?',
                                                           
                                                            type: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, delete it!'
                                                            }).then((result) => {
                                                            if (result.value) {  
                                                                swal(
                                                                    'Deleted!',
                                                                    'Your task has been deleted.',
                                                                    'success'
                                                                )
                                                               $.ajax({
                                                                    'type':'post',
                                                                    'url':"http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id ?>/member/{{$member->user_id}}/deleteadmin",
                                                                    'cache':false,
                                                                    'data':{date:""},
                                                                    'success':function(data){
                                                                        $("#admin-{{$member->id}}").empty();  
                                                                    },
                                                                })
                                                            }   
                                                        })                                                        
                                                    }) 
                                                })
                                            </script>
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>                    
                    </div>                  
                <div class="col-lg-8 col-md-offset-2">
                    <form action="http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id ?>/member/createnewadmin" method="get">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a href="{{url('/admin')}}"> <button type="button" class="btn btn-primary hvr-icon-back">
                                    <i class="glyphicon glyphicon-menu-left hvr-icon"></i></i>
                                     Back
                                </button></a>
                            </div>                            
                            <div class="btn-group" role="group">
                                
                                <a href="{{url('/admin')}}"><button type="submit" class="btn btn-success hvr-icon-back">
                                    <i class="glyphicon glyphicon-plus-sign hvr-icon"></i></i>
                                     Create New Admin
                                </button></a>
                            </div>
                        </div>                       
                    </form>
                </div>                
            </div> 
        </div>
    </div>
@endsection
