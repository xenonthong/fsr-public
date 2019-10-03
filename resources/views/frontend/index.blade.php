<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-off-white font-sans">
<div id="app">
    <router-view></router-view>
</div>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    const Setup = new createSetup({
        'authUser' : @json(Auth::user())
    });

    const apiVersion = 'v1';

    Setup.start();
</script>
</body>
</html>