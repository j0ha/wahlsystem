@extends('layouts.backend_v2')

@section('backendcontent')
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
          <div class="card-header">
              <h5 class="mb-0">Grades of this survery</h5>
              <p>This table shows all the grades of the election and is used to manage them.</p>
          </div>
          <div class="card-body">
              @livewire('backend-schoolgrades-overview', ['electionUUID' => $electionUUID])
          </div>
      </div>
  </div>
</div>
@endsection
