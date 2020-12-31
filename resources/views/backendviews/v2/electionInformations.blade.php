@extends('layouts.backend_v2')

@section('backendcontent')
<br>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-12">
<div class="card">
<div class="card-header">{{ __('Election-Informations') }}</div>

<div class="card-body">

  <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="first_name"><b><h4>{{ __('Election-Name:') }}</h4></b></label>
    <div class="col-md-6">
    <label class="form-control bg-profile"><h5>{{$selectedE[0]->name}}<img class="float-right" src="{{asset('img/padlock.png')}}" alt="" style="width:7%"></h5></label>
  </div>
  </div>

<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="last_name"><b><h4>{{ __('Election-Description:') }}</h4></b></label>
    <div class="col-md-6">
    <label class="form-control bg-profile"><h5>{{$selectedE[0]->description}}<img class="float-right" src="{{asset('img/padlock.png')}}" alt="" style="width:7%"></h5></label>
  </div>
</div>

<div class="form-group row">
     <label class="col-md-4 col-form-label text-md-right" for="email"><h4>{{ __('Election-Type:') }}</h4></label>
     <div class="col-md-6">
     <label class="form-control bg-profile"><h5>{{$selectedE[0]->type}}<img class="float-right" src="{{asset('img/padlock.png')}}" alt="" style="width:7%"></h5></label>
    </div>
</div>

<div class="form-group row">
     <label class="col-md-4 col-form-label text-md-right" for="email"><h4>{{ __('Abstention-Mode:') }}</h4></label>
     <div class="col-md-6">
     <label class="form-control "><h5>@if($selectedE[0]->abstention === 0 ) Deaktiviert @else Aktiviert @endif</h5></label>
    </div>
</div>

<div class="form-group row">
     <label class="col-md-4 col-form-label text-md-right" for="email"><h4>{{ __('Election-Status:') }}</h4></label>
     <div class="col-md-6">
     <label class="form-control"><h5>@if($selectedE[0]->status === "active" ) Active @else Deactivated @endif</h5></label>
    </div>
</div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="email"><h4>{{ __('Manual-Activation:') }}</h4></label>
        <div class="col-md-6">
            <label class="form-control bg-light"><h5>@if($selectedE[0]->manual_voter_activation === 0 ) Active @else Deactivated @endif</h5></label>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="email"><h4>{{ __('Election-Statistics:') }}</h4></label>
        <div class="col-md-6">
            <label class="form-control bg-light"><h5>@if($selectedE[0]->statistics === 0 ) Active @else Deactivated @endif</h5></label>
        </div>
    </div>


</div>
</div>
</div>
</div>
</div>


@endsection
