@extends('site::layouts.app')
 {{ Html::style(('../assets/site/css/Admin/dashboard/dashboard.css')) }}
@section('content')
  <!-- This view is loaded from module: {!! config('admin.name') !!} -->
<body>
	<div class="container  animated fadeIn col-lg-8 col-lg-offset-2">
        <h1 class=" text-center checkinout"><strong>Member List</strong></h1>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-2 text-center">
                        No.
                    </div>
                    <div class="col-lg-10">                        
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
                        <td>
                            <a href="{{ url($url) }}" >
                                {{$user->name}}
                            </a>
                         </td>
                    </tr>
                    @endforeach                  
                </tbody>
              </table>              
            </div>           
        </div>
        <div class="panel-body">
            <a href="{{url('/admin')}}"> 
                <button type="button" class="text-center col-lg-4 col-lg-offset-4 btn btn-primary hvr-icon-back">
                    <i class="glyphicon glyphicon-menu-left hvr-icon"></i>
                    Back
                </button>
            </a>                                        
        </div>
    </div>
</body>
@stop

            