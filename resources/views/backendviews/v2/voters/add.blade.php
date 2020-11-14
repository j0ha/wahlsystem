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
                        <label for="inputText5" class="col-form-label">Nachname</label>
                        <input id="inputText5" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputText6" class="col-form-label">Geburtsdatum</label>
                        <input id="inputText6" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-Mail Adresse</label>
                        <input id="inputEmail" type="email" placeholder="name@beispiel.de" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="input-select">Klasse</label>
                        <select class="form-control" id="input-select">
                            <option>11b</option>
                            <option>11c</option>
                            <option>11d</option>
                            <option>11h</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="submit" value="Speichern" class="btn btn-primary">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nutzer Zugang schicken</label>
                        <div class="switch-button switch-button-success ml-2">
                          <input type="checkbox" checked="" name="switch16" id="switch16"><span>
                          <label for="switch16"></label></span>
                          </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
