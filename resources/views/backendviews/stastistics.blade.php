@extends('layouts.backend')

@section('content')
<h1>Ich bin COOL!</h1>
@php
$election = App\Election::where('uuid', $electionUUID)->get();
@endphp
<h1>{{$election}}</h1>
{{$election->name}}

@endsection
