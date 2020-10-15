<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">


    </style>
    <livewire:styles>
</head>
  <body>
      <!-- Left Side of the Page -->
      <div class="leftside">

        <!-- Logout Tab -->
        <div class="logout">

          <button type="button" name="button">Logout</button>
          

        </div>
        <!-- Namfield consisting Name + Institution -->
        <div class="namefield">

          <span>Name</span>
          <span>Institution</span>

        </div>
        <!-- Navigation -->
        <div class="navbar">

          <a href="#">Link</a>
          <a href="#">Link</a>
          <a href="#">Link</a>

        </div>
        <!-- Live Time -->
        <div class="time">

          Hello Im your Time

        </div>

      </div>
      <!-- Right Side of the Page -->
      <div class="rightside">
        <h2>CSS Test</h2>
        <p>HELLO IM A TEST</p>
        <div class="Heading">

        </div>
        <div class="content">

          <main class="py-4">
              @yield('backendcontent')
          </main>

        </div>

      </div>
  </body>
</html>
