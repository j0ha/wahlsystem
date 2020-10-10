@extends('layouts.app')

@section('content')

<div class="card-body">
  <form method="POST" action="/emailElectionInsert">
    @csrf

  <!-- Name der Wahl -->

  <div class="form-group">
    <label for="emailelectionname">Name</label>
    <input type="text" class="form-control" name="emailelectionname" aria-describedby="emailHelp" placeholder="Enter Electionname">
    <small id="electionnamehelp" class="form-text text-muted">The name should fit well.</small>
  </div>

  <!-- Anazhl Wähler -->
  <div class="form-group">
    <label for="emailelectionteilnehmer">Anzahl der Wähler</label>
    <input type="number" min="2" max="100" class="form-control" name="emailelectioncount" aria-describedby="emailHelp" placeholder="Enter number of participants.">
    <small id="electionnamehelp" class="form-text text-muted">The number can be a nomber from 2-100.</small>
  </div>

 <!-- Enthaltungen? -->
  <div class="form-group">
   <label for="abstentionmode">Select Abstentionmode</label>
   <select class="form-control" name="abstentionselector">
     <option value=1> Allowed </option>
     <option value=0> Declined </option>
   </select>
   <small id="electionnamehelp" class="form-text text-muted">The mode decides wheter the elector can abstain inside of your election or not.</small>
 </div>

 <!-- Submit Button -->
  <button type="submit" class="btn btn-primary">Create Election</button>
</form>
</div>

@endsection