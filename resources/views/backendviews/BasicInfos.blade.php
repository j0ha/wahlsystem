@extends('layouts.backend')

@section('content')
<h1>Name: <b>"{{$selectedE[0]->name}}"</b></h1>

<h1>Description: <b>"{{$selectedE[0]->description}}"</b></h1>

<h1>Abstention-Mode: @if($selectedE[0]->abstention === 0 ) Deaktiviert @else Aktiviert @endif </h1>

<h1>Status: @if($selectedE[0]->status === "active" ) Active @else Deactivated @endif </h1>

<h1>Election-Type: <b>"{{$selectedE[0]->type}}"</b></h1>
@endsection
