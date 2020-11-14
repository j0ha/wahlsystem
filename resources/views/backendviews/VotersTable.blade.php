@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Benutzer</div>

                <div class="card-body">
                  @livewire('voters-table', ['electionUUID' => $electionUUID])
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
