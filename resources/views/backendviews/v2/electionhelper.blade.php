@extends('layouts.backend_v2')

@section('backendcontent')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title">Adding Electionhelper</h3>
                <p>By inviting user via email you can grant them access to your election.</p>
            </div>
            <div class="card">
                <h5 class="card-header">Electionhelper</h5>
                <div class="card-body">
                    <form action="{{route('electionHelper')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="helperEmail" class="col-form-label">Email</label>
                            <input name="helperEmail" id="helperEmail" type="email" class="form-control" placeholder="helper@einfachabstimmen.com">
                            <input type="hidden" name="electionUUID" value="{{$electionUUID}}">
                            @error('candidateName') <span class="error text-danger"> {{ $message }} </span> @enderror
                        </div>
                        @if(\Session::has('emailError'))
                            <span class="error text-danger">{{\Session::get('emailError')}}</span>
                        @endif
                        @if(\Session::has('permissionError'))
                            <span class="error text-danger">{{\Session::get('permissionError')}}</span>
                        @endif
                        @if(\Session::has('ownEmail'))
                            <span class="error text-danger">{{\Session::get('ownEmail')}}</span>
                        @endif
                        <div class="form-group">
                            <input type="submit" name="submit" value="Sumbit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
