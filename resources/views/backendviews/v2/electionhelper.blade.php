@extends('layouts.backend_v2')

@section('backendcontent')
    @if(\Session::has('ownEmail'))
        <span class="error text-sucess">{{\Session::get('success')}}</span>
    @endif
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
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Electionhelpers-Table</h5>
                <div class="card-body">

            <div class="table-responsive">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Status</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->surname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><span class="badge badge-pill badge-success mx-1">Active</span></td>

                                </tr>
                            @endforeach
                            @foreach($pendingUser as $p)
                                <tr>
                                    <td>{{$p[0]->name}}</td>
                                    <td>{{$p[0]->surname}}</td>
                                    <td>{{$p[0]->email}}</td>
                                    <td><span class="badge badge-pill badge-danger mx-1">Pending</span></td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>           <!-- END -->

@endsection
