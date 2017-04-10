<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="{{asset('js/jquery-3.1.1.js')}}"></script>
    <script src="{{asset('semantic/semantic.js')}}"></script>
    <link rel="stylesheet" href="{{asset('semantic/semantic.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>

     {{--<script src='//cloud.tinymce.com/stable/tinymce.min.js'></script>--}}

    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
</head>

<body>
@yield('navbar')
<div class="ui basic segment">
    @yield('content')
</div>
@yield('footer')
</body>
</html>