<?php 
$configs = getSiteConfigs();

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $configs->title }} 
            @isset($title)
                | {{$title}}
            @endisset 
        </title>

        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <script src="{{asset('bootstrap/js/jquery.min.js')}}"></script>

        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>

        <script src="{{ asset('js/app.js') }}?v=1"></script>

    </head>
    <body>

        @if (isset($template) )
            @include($template)
        @else 
            @if(isset($module))
                @include($module)
            @endif;
        @endif
        
    </body>
</html>