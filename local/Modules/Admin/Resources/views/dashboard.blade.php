@extends('admin::layouts.app')
<style type="text/css">
   .checkinout{
       margin-top:150px;
       margin-bottom:100px;
   }
   .btn-circle.btn-xl {
        width: 300px;
        height: 300px;
        padding: 10px 16px;
        border-radius: 150px;
        font-size: 30px;
        line-height: 1.33;
    }        
</style>
@section('content')
  <!-- This view is loaded from module: {!! config('admin.name') !!} -->
<body>
	<div class="container text-center ">
        <h1 class="text-center text-success checkinout">Admin</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-1">
                        <i class="fa fa-comments fa-5x">No.</i>
                    </div>
                    <div class="col-xs-11 text-center">
                        
                        <div>Name</div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
              <table class="table ">
                <tbody>
                  
                    @foreach( $users as $user )
                        <?php 
                          $id = Auth::user()->id;
                          $url = "admin/$id/showprofile/$user->id";
                        ?>
                    <tr>
                      <td class="text-center"><a href="{{ url($url) }}">{{$user->id}}</a></td>
                      <td><a href="#" >{{$user->name}}</a></td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
              
            </div>           
        </div>
        <div class="panel-body">
            <?php
                $id =  Auth::user()->id ;
                $url = "admin/";
            ?>
            <div class="text-center">
                <a class="btn btn-primary" name="edit"  href="{{ url($url) }}">Back</a>  
            </div>                                           
        </div>
    </div>
</body>
@stop

            