@extends('layouts.backend_v2')

@section('backendcontent')
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
          <div class="card-header">
              <h5 class="mb-0">Terminals of this survery</h5>
              <p>This table displays all the terminals of this survery and is used to manage these</p>
          </div>
          <div class="card-body">
              @livewire('backend-terminals-overview', ['electionUUID' => $electionUUID])
          </div>
      </div>
  </div>
</div>
<script type="application/javascript">
    function copyURL() {
        var url = document.getElementById("url");
        url.select();
        document.execCommand("copy");
    }
</script>
@endsection


