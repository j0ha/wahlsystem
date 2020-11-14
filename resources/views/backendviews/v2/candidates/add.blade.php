@extends('layouts.backend_v2')

@section('backendcontent')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="basicform">
            <h3 class="section-title">Einzelnen Nutzer hinzufügen</h3>
            <p>Einen einzelnen Nutzer zu der Wahl hinzufügen.</p>
        </div>
        <div class="card">
            <h5 class="card-header">Nutzerdaten</h5>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Name</label>
                        <input id="inputText3" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputText5" class="col-form-label">Beschreibung</label>
                        <input id="inputText5" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputText6" class="col-form-label">Level</label>
                        <input id="inputText6" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="input-select">Typ</label>
                        <select class="form-control" id="input-select">
                            <option>Schulsprecherwahl</option>
                        </select>
                    </div>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Bild</label>
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
