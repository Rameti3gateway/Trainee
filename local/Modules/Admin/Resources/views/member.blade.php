@extends('site::layouts.app')


@section('content')
  <!-- This view is loaded from module: {!! config('admin.name') !!} -->
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Member</strong></div>              
                <div class="panel-body ">
                    <table class="table ">
                        <tbody>
                            <div class="col-xs-2 text-center">
                                <i class="fa fa-comments fa-5x">No.</i>
                            </div>
                            <div class="col-xs-7 text-center">
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
                                        <button type="submit" class="btn btn-warning" >
                                            <a class="fa fa-btn fa-trash"></a>Edit
                                        </button>
                                    </form>
                                </td>
                                <td class="col-xs-3">
                                    
                                    <!-- <button type="submit" class="btn btn-danger" id="deletebutton-{{$member->user_id}}" >
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                    </button> -->
                                    
                                    <!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{$member->user_id}}">Delete</button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal-{{$member->user_id}}" role="dialog">
                                        <div class="modal-dialog">
                                        
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                Delete
                                            </div>
                                            <div class="modal-body">
                                            <p>Do you really want to delete {{$member->name}}</p>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="deletebutton-{{$member->user_id}}">Yes</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                            
                                    
                                    <script>
                                        $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                        }
                                        });
                                        $(function($){
                                            
                                            $("#deletebutton-{{$member->user_id}}").click(function(){
                                                
                                                
                                                $.ajax({
                                                    'type':'post',
                                                    'url':"http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id ?>/member/{{$member->user_id}}/deleteadmin",
                                                    'cache':false,
                                                    'data':{date:""},
                                                    'success':function(data){
                                                        $("#admin-{{$member->id}}").empty();
                                                        
                                                    
                                                    },
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
            <div class="col-md-6 col-md-offset-3">
                <form action="http://localhost/Laravel/Trainee/local/admin/<?php echo Auth::user()->id ?>/member/createnewadmin" method="get">
                    <button type="submit" class="btn btn-default ">
                        <i class="fa fa-btn fa-plus"></i>Create New Admin
                    </button>
                </form>
            </div> 
        </div> 
    </div>
</div>
</body>
@stop
