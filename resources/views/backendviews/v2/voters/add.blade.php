@extends('layouts.backend_v2')

@section('backendcontent')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Nutzerdaten</h5>
                </div>
                <div class="card-body">
                    @livewire('backend-create-voter', ['electionUUID' => $electionUUID])
                </div>
            </div>
        </div>
    </div>
@endsection
