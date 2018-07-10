<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
      
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>    
    <!-- Styles-->
    {{ Html::style(('../assets/bower_components/animate.css/animate.css')) }} 

    <link rel="stylesheet" href="../assets/site/welcometemplete/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/site/welcometemplete/css/animate.min.css">

  	<link rel="stylesheet" href="../assets/site/welcometemplete/css/et-line-font.css">
	<link rel="stylesheet" href="../assets/site/welcometemplete/css/font-awesome.min.css">

  	<link rel="stylesheet" href="../assets/site/welcometemplete/css/vegas.min.css">
	<link rel="stylesheet" href="../assets/site/welcometemplete/css/style.css">

	<link href='https://fonts.googleapis.com/css?family=Rajdhani:400,500,700' rel='stylesheet' type='text/css'>
    
       
 </head>
<body> 
     <nav class="navbar navbar-inverse navbar-static-top">
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
                <a class="navbar-brand" href="{{ url('/site') }}">
                   {{ config('app.Home', 'Home') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

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
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>       
      @yield('content')  
    
    <!-- javscript js -->
    <script src="../assets/site/welcometemplete/js/jquery.js"></script>
    <script src="../assets/site/welcometemplete/js/bootstrap.min.js"></script>
    <script src="../assets/site/welcometemplete/js/vegas.min.js"></script>

    <script src="../assets/site/welcometemplete/js/wow.min.js"></script>
    <script src="../assets/site/welcometemplete/js/smoothscroll.js"></script>
    <script src="../assets/site/welcometemplete/js/custom.js"></script>  
</body>
</html>