@extends('layouts.app')

@section('content')

<h1>Personal Informations</h1>
<hr>
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
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings">Privacy</a></li>

  </ul>


<div class="tab-content">
<!--Starting of Profile Tab-->
<div class="tab-pane active" id="home">

<hr>
<b><u><h2>Your Profilepage: </h2></u></b>
<form class="form" action="/dvi/profil/update" method="POST">
  @csrf


  <div class="col-xs-6">
      <label for="first_name"><b><h4>First name:</h4></b></label>
      <br>
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"><h5>{{$user->surname}}</h5></i></span>
      <!-- <span class="" for="surname"><h5>{{$user->surname}}</h5></span> -->
      <!-- <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any."> -->
  </div>



  <div class="col-xs-6">
    <label for="last_name"><h4>Last name:</h4></label>
    <br>
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"><h5>{{$user->name}}</h5></i></span>
    <!-- <span for="lastname"><h5>{{$user->name}}</h5></span> -->
    <!-- <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any."> -->
  </div>



    <div class="col-xs-6">
       <label for="email"><h4>Email</h4></label>
       <br>
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"><h5>{{$user->email}}</h5></i></span>
       <!-- <span for="email"><h5>{{$user->email}}</h5></span> -->
       <!-- <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email."> -->
    </div>


  <div class="form-group">
    <div class="col-xs-6">
      <label for="location"><h4>Location</h4></label>
      <br>
      <select class="custom-select" name="location">
        @foreach($locations as $loc)
        <option value="{{$loc['short']}}">{{$loc['name']}}</option>
        @endforeach
      </select>
      <!-- <input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location"> -->
    </div>
  </div>

  <div class="form-group">
    <div class="col-xs-6">
       <label for="email"><h4>City</h4></label>
       <input type="text" class="form-control" name="city" id="city" placeholder="Example: Hamburg" title="Enter your City.">
    </div>
  </div>

  <div class="form-group">
    <div class="col-xs-6">
       <label for="email"><h4>Institution</h4></label>
       <input type="text" class="form-control" name="institution" id="institution" placeholder="Example: StS Walddörfer" title="Enter your institution.">
    </div>
  </div>



    <div class="col-xs-12">
      <label for="password"><h4>Reset your password:</h4></label>
      <br>
       <a class="btn btn btn-danger" href="{{route('password.update')}}" >Reset Password</a>
    </div>



  <div class="form-group">
      <div class="col-xs-12">
        <br>
        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Update</button>
      </div>
  </div>

  </form>

  <hr>
  </div>
  <!--Ending of Profile Tab-->

  <!--Starting of Privacy Tab-->

  <div class="tab-pane" id="permissions">
    <br>
           <h4>List of your permissions:</h4>



  </div>
  <!--Ending of Privacy Tab-->
  <div class="tab-pane" id="settings">
    <br>
           <h4>Privacy Settings:</h4>


  </div>
  </div><!--/tab-pane-->

  </div><!--/tab-content-->
  </div><!--/col-9-->
  </div><!--/row-->
@endsection
