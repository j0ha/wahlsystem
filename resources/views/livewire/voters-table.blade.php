<div>

  <div class="row justify-content-center">
  <div class="col-md-10">
  <div class="card">
  <div class="card-header">{{ __('Voters-Table') }}</div>
    <div class="card-body">
      <div class="form-group">
          <input wire:model.debounce.300ms="search" type="text" class="" placeholder="Search users...">

          <select wire:model="orderBy" class="" id="">
              <option value="id">ID</option>
              <option value="name">Name</option>
              <option value="email">Email</option>
              <option value="created_at">Sign Up Date</option>
          </select>

          <select wire:model="orderAsc" class="" id="">
              <option value="1">Ascending</option>
              <option value="0">Descending</option>
          </select>

          <select wire:model="perPage" class="" id="">
              <option>10</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
          </select>

      </div>
    </div>
  <table class="table col-md-11 table-bordered">
      <thead class="thead-dark">
          <tr>
              <th scope="col" class="">ID</th>
              <th scope="col" class="">Name</th>
              <th scope="col" class="">Email</th>
              <th scope="col" class="">Created At</th>


  <div class="form-group row">
    <label for="name" class="col-4 col-form-label">Suche</label>
    <div class="col-8">
      <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="z.B. Peter">
    </div>
  </div>
  <div class="form-group row">
    <label for="orderBy" class="col-4 col-form-label">Sortieren nach</label>
    <div class="col-8">
      <select wire:model="orderBy" id="orderBy" name="orderBy" required="required" class="custom-select">
        <option value="id">ID</option>
        <option value="name">Name</option>
        <option value="surname">Nachname</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="orderAsc" class="col-4 col-form-label"></label>
    <div class="col-8">
      <select wire:model="orderAsc" id="orderAsc" name="orderAsc" required="required" class="custom-select">
        <option value="1">Aufsteigend</option>
        <option value="0">Absteigend</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="perPage" class="col-4 col-form-label">Ergebnisse pro Seite</label>
    <div class="col-8">
      <select wire:model="perPage" id="perPage" name="perPage" required="required" class="custom-select">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
      </select>
    </div>
  </div>
  @if($updateMode)
  <div class="card border-success">
    <div class="card-header">
      Bearbeiten
    </div>
    <div class="card-body">

      <input type="hidden" wire:model="userUUID">
      <div class="form-group row">
        <label for="name" class="col-4 col-form-label">Name</label>
        <div class="col-8">
          <input wire:model="name" id="name" name="name" placeholder="z.B. Peter" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="surname" class="col-4 col-form-label">Nachname</label>
        <div class="col-8">
          <input wire:model="surname" id="surname" name="surname" placeholder="z.B. Schmidt" type="text" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="birthday" class="col-4 col-form-label">Geburtstag</label>
        <div class="col-8">
          <input wire:model="birth_year" id="birthday" name="birthday" placeholder="Geburtstag" type="date" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-4 col-form-label">E-Mail</label>
        <div class="col-8">
          <input wire:model="email" id="email" name="email" placeholder="E-Mail" type="email" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-4 col-8">
          <button wire:click="update()" class="btn btn-primary">Aktualisieren</button><button wire:click="cancel()" class="btn btn-secundary">Abbrechen</button>
        </div>
      </div>



    </div>
  </div>
  @endif
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Nachname</th>
              <th scope="col">Geburtstag</th>
              <th scope="col">E-Mail</th>
              <th scope="col">Status</th>
              <th scope="col">Bearbeiten</th>

          </tr>
      </thead>
      <tbody>
          @foreach($voters as $voter)
              <tr>

                  <td scope="col" class="">{{ $voter->id }}</td>



                  <td class="border">{{ $voter->id }}</td>
                  <td class="border">{{ $voter->name }}</td>
                  <td class="border">{{ $voter->surname }}</td>
                  <td class="border">{{ $voter->birth_year }}</td>
                  <td class="border">{{ $voter->email }}</td>
                  <td class="border">@if($voter->voted_via_email) <span class="badge badge-success mx-1">Direct</span>@elseif ($voter->voted_via_terminal)<span class="badge badge-success mx-1">Terminal</span>@else<span class="badge badge-secondary mx-1">Freigeschalten</span>@endif @if( $voter->got_email )<span class="badge badge-success mx-1">E-Mail</span>@else<span class="badge badge-secondary mx-1">E-Mail</span>@endif</td>
                  <td class="border"><button wire:click.lazy="editVoter('{{$voter->uuid}}')" type="button" class="btn btn-secondary mx-1">Bearbeiten</button><button wire:click.lazy="deleteVoter('{{$voter->uuid}}')" type="button" class="btn btn-danger mx-1">Löschen</button></td>

              </tr>
          @endforeach
      </tbody>
  </table>

</div>
</div>
</div>
</div>
</div>

 </div>
