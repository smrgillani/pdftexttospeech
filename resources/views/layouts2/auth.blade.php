<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

        @include('common.header')
        <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
</head>
<body>
 @yield('content')
@include('common.footer')
</body>

</html>
