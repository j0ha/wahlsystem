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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUIyJ" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


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
              <li class="navigation-list-item"><a href="{{route('homeE', ['electionUUID' => $electionUUID])}}">Basic Informations</a></li>
              <li class="navigation-list-item"><a href="{{route('stats', ['electionUUID' => $electionUUID])}}">Statistics</a></li>
              <li class="navigation-list-item"><a href="">Voter Administration</a></li>
              <li class="navigation-list-item"><a href="">Add Voters</a></li>
              <li class="navigation-list-item"><a href="">Basic Informations</a></li>
              <li class="navigation-list-item"><a href="">Basic Informations</a></li>
            </ul>
          </div>
          <div class="timefooter">
            <!-- <script type="text/javascript">
            function time(){
              var d = new Date();
              var s = d.getSeconds();
              var m = d.getMinutes();
              var h = d.getHours();
              document.write(h + ":" + m + ":" + s);
            }
            </script> -->
            <span class="timefooter-timestamp">09:41 CET 10.09.2020</span>
            <span class="timefooter-session">Session: f673f2ca-3e86-4f40-8184-746ea2c29e95</span>
          </div>
        </div>
        <div class="secondcloum">
          <div class="header">
            <!-- <span class="election-selector">Louisenlund Dorm REP Wahl</span> -->
            <div class="dropdown">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Election-Selector
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                @foreach($elections as $e)
                <a class="dropdown-item" href="{{ route('homeE', ['electionUUID' => $e->uuid]) }}">{{$e->name}}</a>
                @endforeach
              </div>
            </div>


        </div>
        <div class="content">
          @yield('content')
        </div>
      </div>
  </body>
</html>
