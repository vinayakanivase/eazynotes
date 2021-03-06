<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="api-token" content="{{ api_token() }}">

  <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
  
  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>

  <!-- Content -->
  <div id="app">
    @yield('content')
  </div>
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
