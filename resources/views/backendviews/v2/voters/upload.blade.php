@extends('layouts.backend_v2')

@section('backendcontent')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="basicform">
            <h3 class="section-title">Mehrere Nutzer hinzufügen</h3>
            <p>Mehrere Nutzer per Datei zu der Wahl hinzufügen</p>
        </div>
        <div class="card">
            <h5 class="card-header">Upload</h5>

            <div class="card-body">
                <form action="{{route('votersAddMany')}}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="custom-file mb-3">
                      <input type="file" name="votersFile" class="custom-file-input" id="customFile">
                      <input type="hidden" name="electionUUID" value="{{$electionUUID}}">
                      @if ($errors->has('votersFile'))
                          <span class="help-block">
                              <strong>{{ $errors->first('votersFile') }}</strong>
                          </span>
                      @endif
                      <label class="custom-file-label" for="customFile">File</label>

                      <p>CSV-Format: Name; Nachname; E-Mail; Klasse; Jahrgang; Geburtsdatum;</p>
                  </div>

                  <div class="form-group">
                      <label class="col-form-label">Does the File have an header?</label>
                      <div class="switch-button switch-button-success ml-2">
                        <input type="checkbox" checked="" name="header" id="switch16"><span>
                        <label for="switch16"></label></span>
                        </div>
                  </div>
                    <div class="form-group">
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="directly" class="custom-control-input" value="true"><span class="custom-control-label">Create direct access</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="directly" class="custom-control-input" value="false"><span class="custom-control-label">Do not create direct access</span>
                        </label>
                    </div>

                  <div class="form-group">
                      <input type="submit" name="submit" placeholder="Upload" class="btn btn-primary">
                  </div>

                    @if(\Session::has('successUpload'))
                        <span class="error text-success">{{\Session::get('successUpload')}}</span>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
