<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    
<div class="illustration">
    <img src="{{ asset('images/frame.png') }}">
</div>
<div class="content">
    <div class="rata-tengah">
        <img src="{{ asset('images/logo.png') }}" alt="">
    </div>
    @yield('content')
</div>

<script src="{{ asset('js/base.js') }}"></script>

</body>
</html>