@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Register - Set up Google Authenticator') }}</div>

                    <div class="card-body">
                        <p>A 2FA is nessesary to use this system. You can set it up, by scaning the QR-Code with an APP like "Google Authenticator" or by adding the scecret into your desired software.</p>
                        <!-- Regristrieren "Vorname"-->
                            <div class="form-group row">
                                <label for="secret" class="col-md-4 col-form-label text-md-right">{{ __('Secret') }}</label>

                                <div class="col-md-6">
                                    <input id="secret" type="text" class="form-control" name="secret" value="{{ $secret }}">
                                </div>
                            </div>
                            <!-- Regristrieren "Name"-->
                            <div class="form-group row">

                                    <label for="QR" class="col-md-4 col-form-label text-md-right">{{ __('QR-Code') }}</label>

                                    <div class="col-md-8">
                                        {{ QrCode::size(200)->generate($QR_URL) }}
                                        <a href="https://apps.apple.com/de/app/microsoft-authenticator/id983156458" target="_blank"><img src="{{asset('img/app-store-badge.svg')}}" alt="" ></a>
                                        <a href="https://play.google.com/store/apps/details?id=com.azure.authenticator&hl=de&gl=US" target="_blank"><img src="{{asset('img/google-play-badge.png')}}" alt="" style="width:26%;"></a>
                                    </div>



                                
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{route('complete.2fa')}}" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </a>
                                </div>
                            </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

