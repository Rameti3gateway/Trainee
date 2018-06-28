<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <!-- Styles -->
    <!-- {{ Html::style(('../assets/bower_components/bootstrap/dist/css/bootstrap.css')) }}   -->
    {{ Html::style(('../assets/site/css/themes/app.css')) }}
    <!-- {{ Html::script(('../assets/bower_components/jquery/dist/jquery.min.js')) }}    -->
    {{ Html::script(('../assets/site/js/app.js')) }}
       
    <!-- Styles home -->    
    

    <!-- Styles-->
    {{ Html::style(('../assets/bower_components/animate.css/animate.css')) }} 
       
 </head>
<body onload="startTime()">   
    <nav class="navbar-inverse">
        <div class="container">
            <div class="navbar-header">  

                <!-- Branding Image -->                
                    <a class="navbar-brand" href="{{ url('/site') }}">
                        {{ config('app.Home', 'Home') }}
                    </a>
                
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">               

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('site/login') }}">Login</a></li>
                        <li><a href="{{ url('site/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
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
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="contrianer">
         @yield('content')         
    </div>   
    <!-- Scripts -->  
    <!-- {{ Html::script(('../assets/site/js/app.js')) }}     -->
    <!-- {{ Html::script(('../assets/bower_components/jquery/dist/jquery.min.js')) }}    -->
</body>
</html>