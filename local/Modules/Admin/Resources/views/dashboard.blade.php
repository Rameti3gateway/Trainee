@extends('site::layouts.app')

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
	<div class="container text-center animated zoomIn">
        <h1 class="text-center text-success checkinout"><strong>Admin</strong></h1>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-1">
                        No.
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
                      <td><a href="{{ url($url) }}" >{{$user->name}}</a></td>
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
            <div class="text-center col-lg-4 col-lg-offset-4">
                <a class="btn btn-primary btn-lg btn-block" name="edit"  href="{{ url($url) }}">Back</a>  
            </div>                                           
        </div>
    </div>
</body>
@stop

            