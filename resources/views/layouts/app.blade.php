<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WTECH Shop - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/products_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navfoot_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_style.css') }}">
    <script src="{{ asset('js/Login_Register_swap.js') }}"></script>
    @yield('scripts')
</head>
<body>
@include('common.header')
@include('common.nav')

@yield('main')

@include('common.modal')
@include('common.footer')
</body>
</html>
