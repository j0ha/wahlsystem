@extends('layouts.backend_v2')

@section('backendcontent')
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
          <div class="card-header">
              <h5 class="mb-0">School classes in the survey</h5>
              <p>This table shows all school classes of choice and is used to manage them.</p>
          </div>
          <div class="card-body">
              @livewire('backend-schoolclasses-overview', ['electionUUID' => $electionUUID])
          </div>
      </div>
  </div>
</div>
@endsection
