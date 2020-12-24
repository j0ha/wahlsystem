@extends('layouts.backend_v2')

@section('backendcontent')
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
          <div class="card-header">
              <h5 class="mb-0">Terminals der Wahl</h5>
              <p>Diese Tabelle zeigt alle Terminals der Wahl an und dient zur Verwaltung dieser.</p>
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


