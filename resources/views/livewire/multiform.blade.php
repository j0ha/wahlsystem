<div>
  <h1>Create your own and differentiated Election!</h1>
  <form wire:submit.prevent="submit" method="POST">

  <!-- Name der Wahl -->
  @if($step == 0)
  <div class="form-group">
    <label for="electionName">Name</label>
    <input type="text" class="form-control" wire:model.lazy="name" name="electionName" aria-describedby="electionNameHelp" placeholder="Enter Electionname">
    @error('name') <span class="error"> {{ $message }} </span> @enderror
    <small id="electionnamehelp" class="form-text text-muted">The Name of your Election should fit well.</small>
  </div>

  <!-- Beschreibung / Fragestellung  -->

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" wire:model.lazy="description" name="electionDescription" aria-describedby="electionDescriptionHelp" placeholder="Type in the Description of the Election.">
    @error('description') <span class="error"> {{ $message }} </span> @enderror
    <small id="electionDescriptionHelp" class="form-text text-muted">Type in whether the questioning or the problematic of the topic that the election is dealing with.</small>
  </div>
@endif
 <!-- Wahltyp -->
@if($step == 1)
  <div class="form-group">
   <label for="electionMode">Select the Electionmode</label>
     @foreach ($modes as $m)
      <label>{{$m->name}}</label>
      <input type="radio" wire:model.lazy="mode" name="type" value="{{$m->mode}}">
     @endforeach
   <small id="electionnamehelp" class="form-text text-muted">The mode decides wheter the elector can abstain inside of your election or not.</small>
 </div>
@endif
@if($step > 0 && $step <= 1)
  <!-- Submit Button -->
  <button type="button" wire:click="decreaseStep" class="btn btn-primary">Backwards</button>
@endif
@if($step < 1)
  <!-- Submit Button -->
  <button type="button" wire:click="increaseStep" class="btn btn-primary">Next</button>
@endif
@if($step == 1)
  <!-- Submit Button -->
  <button type="submit" class="btn btn-primary">Submit</button>
@endif



</form>
</div>
