<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/bd94cbc531.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUIyJ" crossorigin="anonymous">
    <!-- Styles -->
    <!-- <link href="{{ asset('css/profile.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <livewire:styles>
  </head>
  <body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                  <a class="dropdown-item" href="{{ route('homeWE') }}">{{ __('Election-Backend') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

      <br>
    <div class="container bootstrap snippet">

    <div class="row">
  	<div class="col-sm-3"><!--left col-->


    <ul class="list-group">
     <li class="list-group-item text-muted">Usage table: <i class="fa fa-dashboard fa-1x"></i></li>
     <li class="list-group-item text-right"><span class="pull-left"><strong>Alltime Elections: </strong></span> 125</li>
     <li class="list-group-item text-right"><span class="pull-left"><strong>Active Elections: </strong></span> 13</li>
     <li class="list-group-item text-right"><span class="pull-left"><strong>Participated: </strong></span> 37</li>
     <li class="list-group-item text-right"><span class="pull-left"><strong>IDK: </strong></span> 78</li>
    </ul>

    </div><!--/col-3-->

    <div class="col-sm-9">
      <ul class="nav nav-tabs">

        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Profile</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#permissions">Permissions</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#privacy">Privacy</a></li>

      </ul>


    <div class="tab-content">
    <!--Starting of Profile Tab-->
    <div class="tab-pane active" id="home">
      <br>
      @if(empty($user->location) OR empty($user->city) OR empty($user->institution))
      <div class="container">
      <div class="row justify-content-center">
      <div class="col-md-12">
      <div class="card">
        <div class="card-body">
        <span class="text-danger">Please complete the registration by filling out the fields:</span>
        @if(empty($user->location))<span> Location </span>@endif
        @if(empty($user->city)) <span>City </span>@endif
        @if(empty($user->institution))<span>Institution</span>@endif
        </div>
      </div>
      </div>
      </div>
      </div>
      <br>
      @endif
      <div class="container">
      <div class="row justify-content-center">
      <div class="col-md-12">
      <div class="card">
      <div class="card-header">{{ __('Profile-RegisterCard') }}</div>

      <div class="card-body">
    <form class="form" action="/dvi/profil/update" method="POST">
      @csrf
        <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right" for="first_name"><b><h4>{{ __('Firstname:') }}</h4></b></label>
          <br>
          <div class="col-md-6">
          <label class="form-control bg-profile"><h5>{{$user->surname}}<img class="float-right" src="{{asset('img/padlock.png')}}" alt="" style="width:6%"></h5></label>
        </div>
        </div>

        <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right" for="last_name"><b><h4>{{ __('Lastname:') }}</h4></b></label>
          <br>
          <div class="col-md-6">
          <label class="form-control bg-profile"><h5>{{$user->name}}<img class="float-right" src="{{asset('img/padlock.png')}}" alt="" style="width:6%"></h5></label>
        </div>
        </div>

        <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right" for="email"><b><h4>{{ __('Email:') }}</h4></b></label>
          <br>
          <div class="col-md-6">
          <label class="form-control bg-profile"><h5>{{$user->email}}<img class="float-right" src="{{asset('img/padlock.png')}}" alt="" style="width:6%"></h5></label>
        </div>
        </div>

      @if(empty($user->location))
      <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right" for="location"><h4>{{ __('Location:') }}</h4></label>
          <div class="col-md-6">
          <select class="custom-select border border-danger" name="location">
            @foreach($locations as $loc)
            <option value="{{$loc['short']}}">{{$loc['name']}}</option>
            @endforeach
          </select>
        </div>
      </div>
      @else
      <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="location"><b><h4>{{ __('Location:') }}</h4></b></label>
        <br>
        <div class="col-md-6">
        <label class="form-control"><h5>{{$user->location}}</h5></label>
      </div>
      </div>
      @endif

      @if(empty($user->city))
      <div class="form-group row">
           <label class="col-md-4 col-form-label text-md-right" for="city"><h4>{{ __('City:') }}</h4></label>
           <div class="col-md-6">
           <input type="text" class="form-control border border-danger" name="city" id="city" placeholder="Example: Hamburg" title="Enter your City.">
         </div>
      </div>
      @else
      <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="city"><b><h4>{{ __('City:') }}</h4></b></label>
        <br>
        <div class="col-md-6">
        <label class="form-control"><h5>{{$user->city}}</h5></label>
      </div>
      </div>
      @endif

      @if(empty($user->institution))
      <div class="form-group row">
           <label class="col-md-4 col-form-label text-md-right" for="email"><h4>{{ __('Institution:') }}</h4></label>
           <div class="col-md-6">
           <input type="text" class="form-control border border-danger" name="institution" id="institution" placeholder="Example: StS Walddörfer" title="Enter your institution.">
         </div>
      </div>
      @else
      <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="institution"><b><h4>{{ __('Institution:') }}</h4></b></label>
        <div class="col-md-6">
        <label class="form-control"><h5>{{$user->institution}}</h5></label>
      </div>
      </div>
      @endif


      <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right" for="password"><h4>{{ __('Reset your Password:') }}</h4></label>
          <div class="col-md-6">
           <a class="btn btn btn-danger" href="{{route('password.update')}}">Reset Password</a>
         </div>
      </div>

      @if(empty($user->location) OR empty($user->city) OR empty($user->institution))
      <div class="form-group">
            <label class="col-md-4 col-form-label text-md-right" for="update"><h4>{{ __('Complete Registration:') }}</h4></label>

            <button class="btn btn-lg btn-success" type="submit">Update</button>

      </div>
      @endif
      </form>
    </div>
    </div>
    </div>
    </div>
      <hr>
    </div>
    </div>
      <!--Ending of Profile Tab-->

      <!--Starting of Permission Tab-->

      <div class="tab-pane" id="permissions">
        <br>
        <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
        <div class="card-header">{{ __('Profile-RegisterCard') }}</div>

        <div class="card-body">
          <h5>Roles:</h5>

          <h5>Permissions:</h5>

          <ul>
            @foreach($allPermissions as $perms)
            @if(strlen($perms) != 36)
            <li>{{$perms->name}}</li>
            @endif
            @endforeach
          </ul>

        </div>
        </div>
        </div>
        </div>
        </div>

      </div>
      <!--Ending of Permisson Tab-->

      <!--Starting of Privacy Tab-->
      <div class="tab-pane" id="privacy">
        <br>

        <livewire:deleteprofile>


      </div>
      <!--Ending of Privacy Tab-->

      </div><!--/tab-pane-->
      </div><!--/tab-content-->
      </div><!--/col-9-->
      </div><!--/row-->
      <livewire:scripts>
  </body>
</html>
