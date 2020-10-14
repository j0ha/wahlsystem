<div>
  <h1>Testingpage</h1>
  <form wire:submit.prevent="submit">


  <!-- Name der Wahl -->
  @if($step == 0)
  <div class="form-group">
    <label for="electionName">Name</label>
    <input type="text" class="form-control" wire:model.lazy="name" name="electionName" aria-describedby="electionNameHelp" placeholder="Enter Electionname">
    <small id="electionnamehelp" class="form-text text-muted">The Name of your Election should fit well.</small>
  </div>

  <!-- Beschreibung / Fragestellung  -->

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" wire:model.lazy="description" name="electionDescription" aria-describedby="electionDescriptionHelp" placeholder="Type in the Description of the Election.">
    <small id="electionDescriptionHelp" class="form-text text-muted">Type in whether the questioning or the problematic of the topic that the election is dealing with.</small>
  </div>
@endif
 <!-- Wahltyp -->
@if($step == 1)
  <div class="form-group">
   <label for="electionMode">Select the Electionmode</label>
   <select class="form-control" wire:model.lazy="mode" name="electionMode">
     @foreach ($modes as $mode)
      <option value=" {{ $mode->id }} "> {{$mode->name}} </option>
     @endforeach
   </select>
   <small id="electionnamehelp" class="form-text text-muted">The mode decides wheter the elector can abstain inside of your election or not.</small>
 </div>
@endif
@if($step > 0 && $step <= 2)
  <!-- Submit Button -->
  <button type="button" wire:click="decrease" class="btn btn-primary">Backwards</button>
@endif
@if($step <= 2)
  <!-- Submit Button -->
  <button type="submit" class="btn btn-primary">Next</button>
@endif


</form>
</div>
