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
    <link href="https://fonts.googleapis.com/css2?family=Jost" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">


    </style>
    <livewire:styles>
</head>
  <body>
      <div class="main">
        <div class="firstcloum">
          <div class="header">
            <span class="logout-span">Abmelden</span>
            <span class="setting-span">Einstellungen</span>
          </div>
          <div class="namebody">
            <span class="namebody-name">Amelia Hutson</span>
            <span class="namebody-institution">Internat Louisenlund</span>
          </div>
          <div class="navigation">
            <ul class="navigation-list">
              <li class="navigation-list-item">Menu</li>
              <li class="navigation-list-item">Menu</li>
              <li class="navigation-list-item">Menu</li>
              <li class="navigation-list-item">Menu</li>
              <li class="navigation-list-item">Menu</li>
              <li class="navigation-list-item">Menu</li>
            </ul>
          </div>
          <div class="timefooter">
            <span class="timefooter-timestamp">09:41 CET 10.09.2020</span>
            <span class="timefooter-session">Session: f673f2ca-3e86-4f40-8184-746ea2c29e95</span>
          </div>
        </div>
        <div class="secondcloum">
          <div class="header">
            <span class="election-selector">Louisenlund Dorm REP Wahl</span>
          </div>
        </div>
      </div>
  </body>
</html>
