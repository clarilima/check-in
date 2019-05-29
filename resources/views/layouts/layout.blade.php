<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<script src="{{ asset('js/site/app.js') }}" defer></script>--}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        var _init = [];
    </script>
    {{--<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>--}}
    {{--<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>--}}
    {{--<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>--}}
</head>
<body>
<div id="nav-main">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Encontros</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/meeting/create">Criar Encontro</a>
                <a class="dropdown-item" href="/meetings">Check Encontros</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Participantes</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Adicionar Participante</a>
                <a class="dropdown-item" href="#">Consultar Participante</a>
                <a class="dropdown-item" href="#">Consultar Rebanhos</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </li>
    </ul>
</div>
@yield('content')
<script src="{!! asset('js/site/app.js') !!}"></script>
<script>_init.forEach(function(fn){fn();})</script>
{{--@yield('js')--}}
</body>
</html>
