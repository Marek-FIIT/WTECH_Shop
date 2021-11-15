<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WTECH Shop - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/homepage_style.css') }}">
    @yield('scripts')
</head>
<body>
@include('common.header')
@include('common.nav')
<main>
    @yield('main')
</main>
@include('common.modal')
@include('common.footer')
</body>
</html>
