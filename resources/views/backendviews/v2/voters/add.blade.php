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
                <form action="{{route('votersAddSingle')}}" method="POST">
                  @csrf
                  <input type="hidden" name="electionUUID" value="{{$electionUUID}}">
                    <div class="form-group">
                        <label for="voterName" class="col-form-label">Name</label>
                        <input name="voterName" id="voterName" type="text" placeholder="Mustermann" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="voterSurame" class="col-form-label">Surname</label>
                        <input name="voterSurname" id="voterSurname" type="text" placeholder="Max" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="voterDate" class="col-form-label">Geburtsdatum</label>
                        <input name="voterDate" id="voterDate" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="voterEmail">E-Mail Adresse</label>
                        <input name="voterEmail" id="voterEmail" type="email" placeholder="name@beispiel.de" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="voterForm">Forms</label>
                        <select name="voterForm" class="form-control" id="voterForm">
                            @foreach($forms as $form)
                              <option value="{{$form->id}}">{{$form->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="voterClass">Classes</label>
                        <select name="voterClass" class="form-control" id="voterClass">
                          @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="submit" value="Speichern" class="btn btn-primary">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nutzer Zugang schicken</label>
                        <div class="switch-button switch-button-success ml-2">
                          <input type="checkbox" checked="" name="sendEmail" id="switch16"><span>
                          <label for="switch16"></label></span>
                          </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
