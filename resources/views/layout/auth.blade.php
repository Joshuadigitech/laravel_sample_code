<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="public/auth/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/auth/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/auth/css/form-elements.css">
    <link rel="stylesheet" href="public/auth/css/style.css">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/MoneAdmin.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/plugins/Font-Awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/plugins/datepicker/css/datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-fileupload.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/chat.css') }}" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicon and touch icons -->
<link rel="shortcut icon" type="image/png" href="public/auth/ico/favicon.png">
{{--<link rel="apple-touch-icon-precomposed" sizes="144x144" href="public/auth/ico/apple-touch-icon-144-precomposed.png">--}}
{{--<link rel="apple-touch-icon-precomposed" sizes="114x114" href="public/auth/ico/apple-touch-icon-114-precomposed.png">--}}
{{--<link rel="apple-touch-icon-precomposed" sizes="72x72" href="public/auth/ico/apple-touch-icon-72-precomposed.png">--}}
{{--<link rel="apple-touch-icon-precomposed" href="public/auth/ico/apple-touch-icon-57-precomposed.png">--}}

</head>

<body>
    <!-- Top menu -->
    <nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="login">Register to get Solution for your business</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="top-navbar-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <span class="li-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-envelope"></i></a>
                            <a href="#"><i class="fa fa-skype"></i></a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Top content -->
    @yield('content')
      <script src="{{ asset('public/plugins/jquery-2.0.3.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/plugins/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
  
    
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
    <script src="http://momentjs.com/downloads/moment-timezone-with-data-2012-2022.js"></script>
    <script src="http://momentjs.com/downloads/moment-timezone-with-data.js"></script>
    <script src="public/auth/js/jquery-1.11.1.min.js"></script>
    <script src="public/auth/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/auth/js/jquery.backstretch.min.js"></script>
    <script src="public/auth/js/retina-1.1.0.min.js"></script>
    <script src="public/plugins/formValidation/jquery.validate.js"></script>
    <script src="public/auth/js/scripts.js"></script>
      <script src="{{ asset('public/js/jsForSession.js')}}"></script>    
<script src="{{ asset('public/js/custom.js')}}"></script>

    <!--[if lt IE 10]>
    <script src="public/auth/js/placeholder.js"></script>
<![endif]-->

<script src="public/plugins/formValidation/signUpFromValidation.js"></script>
</body>
</html>




{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
    {{-- Title Of Page --}}
    {{--<title>@yield('title')</title>--}}
    {{--<!-- metatags-->--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    {{--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />--}}
    {{--<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);--}}
    {{--function hideURLbar(){ window.scrollTo(0,1); } </script>--}}
    {{--<!-- Meta tag Keywords -->--}}
    {{--<!-- css files -->--}}
    {{--<link href="{{ asset('public/css/registerz.css') }}" rel="stylesheet" type="text/css" media="all"/><!--stylesheet-css-->--}}
    {{--<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">--}}
    {{--<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">--}}

    {{--<!-- //css files -->--}}
{{--</head>--}}
{{--<body>--}}
    {{----}}
    {{-- Heading Of the Page --}}
    {{--<h1>@yield('heading')</h1>--}}

    {{-- Main Content Of Page --}}
    {{--<div class="w3l-main">--}}
        {{--@yield('content')--}}
    {{--</div>   --}}
    {{----}}
    {{--<footer>&copy; 2018. All Rights Reserved | <a href="http://oboxdigitech.com/"> OBoxDigiTech</a>--}}
    {{--</footer>--}}

{{--</body>--}}
{{--</html>--}}