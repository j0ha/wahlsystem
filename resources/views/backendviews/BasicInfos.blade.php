@extends('layouts.backend')

@section('content')
<h2>Name: <b>"{{$selectedE[0]->name}}"</b></h2>

<h2>Description: <b>"{{$selectedE[0]->description}}"</b></h2>

<h2>Abstention-Mode: @if($selectedE[0]->abstention === 0 ) Deaktiviert @else Aktiviert @endif </h2>

<h2>Status: @if($selectedE[0]->status === "active" ) Active @else Deactivated @endif </h2>

<h2>Election-Type: <b>"{{$selectedE[0]->type}}"</b></h2>
@endsection
