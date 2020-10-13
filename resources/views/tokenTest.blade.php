@extends('layouts.app')

@section('content')

<div class="card-body">
  <form method="POST" action="/tokenInsert">
    @csrf

  <!-- Name der Wahl -->

  <div class="form-group">
    <label for="emailelectionname">Name</label>
    <input type="text" class="form-control @error('tokenVName') is-invalid @enderror" name="tokenVName" aria-describedby="emailHelp" placeholder="Enter Electionname">
    @error('title')
      <div class="alert alert-danger"> {{ $message }} </div>
    @enderror
    <small id="electionnamehelp" class="form-text text-muted">The name should fit well.</small>
  </div>

  <!-- Anazhl Wähler -->

  <div class="form-group">
    <label for="emailelectionteilnehmer">Anzahl der Wähler</label>
    <input type="number" min="2" max="100" class="form-control @error('tokenVPartisipants') is-invalid @enderror" name="tokenVPartisipants" aria-describedby="emailHelp" placeholder="Enter number of participants.">
    @error('tokenVPartisipants')
      <div class="alert alert-danger"> {{ $message }} </div>
    @enderror
    <small id="electionnamehelp" class="form-text text-muted">The number can be a nomber from 2-100.</small>
  </div>

 <!-- Enthaltungen? -->

  <div class="form-group">
   <label for="abstentionmode">Select Abstentionmode</label>
   <select class="form-control @error('tokenVAbstention') is-invalid @enderror" name="tokenVAbstention">
     <option value=1> Allowed </option>
     <option value=0> Declined </option>
   </select>
   @error('tokenVAbstention')
     <div class="alert alert-danger"> {{ $message }} </div>
   @enderror
   <small id="electionnamehelp" class="form-text text-muted">The mode decides wheter the elector can abstain inside of your election or not.</small>
 </div>

 <!-- Submit Button -->
  <button type="submit" class="btn btn-primary">Create Election</button>
</form>
</div>

@endsection
