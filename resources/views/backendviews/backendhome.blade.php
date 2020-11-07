@extends('layouts.backend')

@section('content')


<p>You firstly have to select an election above!</p>
@foreach($electionArray as $a)
<p>{{$a}}</p>
@endforeach
@endsection
