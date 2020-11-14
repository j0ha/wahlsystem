@extends('layouts.backend_v2')

@section('backendcontent')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="basicform">
            <h3 class="section-title">Mehrere Fragen hinzufügen</h3>
            <p>Mehrere Fragen per Datei zu der Wahl hinzufügen</p>
        </div>
        <div class="card">
            <h5 class="card-header">Upload</h5>

            <div class="card-body">
                <form>
                  <div class="custom-file mb-3">
                      <input type="file" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Datei</label>
                      <p>CSV-Format: Name; Beschreibung; Typ; Level;</p>
                  </div>
                    <div class="form-group">
                      <input type="submit" name="submit" value="Speichern" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
