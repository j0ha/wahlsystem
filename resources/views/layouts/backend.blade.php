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
    <script src="{{ asset('js/scripts.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUIyJ" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <livewire:styles>
</head>
  <body onLoad="renderTime();">

      <div class="main">
        <div class="firstcloum">
          <div class="header">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <span class="logout-span">Abmelden</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>




            <a href="{{route('profileData')}}" class="setting"> <img src="{{asset('img\setting_icon.png')}}" alt="settings"> </a>

          </div>
          <div class="namebody">
            <span class="namebody-name">Amelia Hutson</span>
            <span class="namebody-institution">Internat Louisenlund</span>
          </div>
          <div class="navigation">
            @if(!empty($electionUUID))
            <ul class="navigation-list">
              <li class="navigation-list-item" id="{{ (request()->segment(4) == '') ? 'active' : '' }}"><a href="{{route('homeE', ['electionUUID' => $electionUUID])}}" class="navigation-list-item-a">Basic Informations</a></li>
              <li class="navigation-list-item" id="{{ (request()->segment(4) == 'stats') ? 'active' : '' }}"><a href="{{route('stats', ['electionUUID' => $electionUUID])}}">Statistics</a></li>
              <li class="navigation-list-item" id="{{ (request()->segment(4) == 'voters') ? 'active' : '' }}"><a href="{{route('voters', ['electionUUID' => $electionUUID])}}">Overview Voters</a></li>
              <li class="navigation-list-item"><a href="{{route('addingvoters', ['electionUUID' => $electionUUID])}}">Adding single Voters</a></li>
              <li class="navigation-list-item"><a href="{{route('addingbulk', ['electionUUID' => $electionUUID])}}">Adding massive Voters</a></li>
              <li class="navigation-list-item"><a href="">Adding Emails</a></li>
            </ul>
            @endif
          </div>


          <div class="timefooter">

            <span id="clockDisplay" class="timefooter-span" ></span>

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
                <a class="dropdown-item" href="{{ route('creElec') }}" style="color:red; background-color: darkgrey;">Create a new Election</a>
                @foreach($elections as $e)
                <a class="dropdown-item" href="{{ route('homeE', ['electionUUID' => $e->uuid]) }}">{{$e->name}}</a>
                @endforeach
              </div>
            </div>


        </div>
        <div class="content">
          <main class="py-4">
            @yield('content')
          </main>
        </div>
      </div>
      <livewire:scripts>

  </body>
</html>
