<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GLF SEM2 T1</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        
        
        <script src="{{asset('js/app.js')}}" defer></script>

    </head>
    <body id="particles-js" style="background-color:#3b4044;" >

        <div id="app">
            <particles></particles>
        </div>
        
    </body>
</html>