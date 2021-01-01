@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify with your 2FA') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('2fa') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="one_time_password" class="col-md-4 col-form-label text-md-right">{{ __('One Time Password') }}</label>

                            <div class="col-md-6">
                                <input id="one_time_password" type="text" class="form-control" name="one_time_password" placeholder="345 132">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Verify') }}
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


