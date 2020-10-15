@extends('layouts.app')

@section('content')
@livewire('multiform', ['mod => $mode->mode'])
@endsection
