<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <style>
            html, body {

                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }  

</style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
            <a href="{{ url('site/home') }}">Home-->></a>
            @else
            <a href="{{ url('site/login') }}">Login</a>
            <a href="{{ url('site/register') }}">Register</a>
            @endif
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                 System Trainee 
         </div>

         <div class="links">
            @if (Auth::check())
            <a href="https://laravel.com/docs">Profile</a>
            <a href="https://laracasts.com">Checkin-Checkout</a>
            <a href="https://laravel-news.com">To do list</a>
            @else
                <p>*---------------------*</p>
                <h6>i3gateway</h6>
                <h6>digital agency</h6>
                <p>*---------------------*</p>
            @endif
        </div>
    </div>
</div> 
</body>
</html>