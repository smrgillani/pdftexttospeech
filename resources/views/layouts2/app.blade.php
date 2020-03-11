<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

   <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>{{ config('app.name', 'Laravel') }}</title>

       @include('common.header')
   </head>

   <body class="main-dashboard">
   <div class="gooey">
  <span class="dot"></span>
  <div class="dots">
    <span></span>
    <span></span>
    <span></span>
  </div>
</div>

      <section class="main-panel clearfix">
          @include('common.sidebar')
          <div class="content-panel">
             @include('common.topbar')

          @yield('content')

          </div>
      </section>

      @include('common.footer')
      @stack('scripts')
   </body>
</html>