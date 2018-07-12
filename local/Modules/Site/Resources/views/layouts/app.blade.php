<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title')</title>


    <!-- Styles link-->
    {{ Html::style(('../assets/bower_components/bootstrap/dist/css/bootstrap.min.css')) }}    
    {{ Html::style(('../assets/bower_components/animate.css/animate.css')) }} 
    {{ Html::style(('../assets/bower_components/hover/css/hover-min.css')) }}
    {{ Html::script(('../assets/bower_components/jquery/dist/jquery.min.js')) }}   
    {{ Html::script(('../assets/bower_components/bootstrap/dist/js/bootstrap.min.js')) }} 
        
    {{ Html::script(('../assets/bower_components/chart.js/dist/Chart.js')) }}  
    {{ Html::script(('../assets/bower_components/sweetalert2/dist/sweetalert2.all.min.js')) }}  
    
    {{ Html::script(('../assets/bower_components/moment/moment.js')) }}
    {{ Html::script(('../assets/bower_components/moment/min/moment-with-locales.js')) }}
    {{ Html::style(('../assets/bower_components/components-font-awesome/css/font-awesome.min.css')) }}
       
     <!-- Links laravel -->
    {{ Html::style(('../assets/site/css/themes/app.css')) }}  
 </head>
<body class="bg-body"onload="startTime()">   
    <nav class="navbar-inverse">
        <div class="container">
            <div class="navbar-header">  
             <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <a class="navbar-brand" href="{{ url('/admin') }}">
                            {{ config('app.Home', 'Home') }}
                        </a>
                    @else
                        <a class="navbar-brand" href="{{ url('/site') }}">
                            {{ config('app.Home', 'Home') }}
                        </a>
                    @endif      
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">               

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('site/login') }}">Login</a></li>
                        <li><a href="{{ url('site/register') }}">Register</a></li>
                        <li><a href="{{ url('admin/login') }}">Admin</a></li>
                    @else       
                        @php
                            $loginUser = Auth::user();
                        @endphp                  
                        <li class="dropdown">  
                            @if($loginUser->role == 'admin')
                                @php 
                                    $image = App\User::where('id','=',$loginUser->user_id)->pluck('image');
                                    $urlpicadmin = "../upload/img/site/admin-profile-image/$image[0]"; 
                                @endphp
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                                
                                <a href="#" class="dropdown-toggle hvr-shrink" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img width=25"px" height="25px" class="img-circle" src="{{ url($urlpicadmin) }}" alt="photo">
                                    {{ Auth::user()->name }}<span class="caret"></span>
                                </a>
                            @else
                                @php
                                    $image = $loginUser->image;
                                    $urlpicuser = "../upload/img/site/profile-image/$image";
                                @endphp
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        @php
                                            $id = Auth::user()->id;
                                            $url = "site/users/$id/report";
                                        @endphp
                                        <a href="{{ url($url) }}">Export Report</a>                                    
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                                <a href="#" class="dropdown-toggle hvr-shrink" data-toggle="dropdown" role="button" aria-expanded="false">
                                    @if( $loginUser->type == "facebook" || $loginUser->type == "google")  
                                        @if(strstr($loginUser->image,'_',true) == 'user')
                                            <img width=25"px" height="25px" class="img-circle"  src="{{ url($urlpicuser) }}" alt="photo" >
                                        @else
                                            <img width=25"px" height="25px" class="img-circle" src="{{ $loginUser->image }}" alt="photo">
                                        @endif                                     
                                    @else
                                        <img width=25"px" height="25px" class="img-circle" src="{{url($urlpicuser)}}" alt="photo">
                                    @endif      
                                {{ Auth::user()->name }} <span class="caret"></span></a>
                            @endif                      
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="contrianer">
         @yield('content')         
    </div>         
    {{ Html::script(('../assets/bower_components/chart.js/dist/Chart.bundle.js')) }}
    {{ Html::script(('../assets/bower_components/chart.js/dist/Chart.min.js')) }}
    


</body>
</html>