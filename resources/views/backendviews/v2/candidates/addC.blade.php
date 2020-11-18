@extends('layouts.backend_v2')

@section('backendcontent')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="basicform">
            <h3 class="section-title">Adding Candidates</h3>
            <p>You can add a single candidate here.</p>
        </div>
        <div class="card">
            <h5 class="card-header">Candidate</h5>
            <div class="card-body">
                <form action="{{route('candidatesAddSingle')}}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="candidateName" class="col-form-label">Name</label>
                        <input name="candidateName" id="candidateName" type="text" class="form-control" placeholder="Team Strong">
                    </div>
                    <div class="form-group">
                        <label for="candidateDescription" class="col-form-label">Beschreibung</label>
                        <input name="candidateDescription" id="candidateDescription" type="text" class="form-control" placeholder="We are fighting for more digital support in our school!">
                    </div>
                    <div class="form-group">
                        <label for="candidateLevel" class="col-form-label">Level</label>
                        <input name="candidateLevel" id="candidateLevel" type="number" class="form-control" placeholder="Type in the level of the question.">
                    </div>
                    <input type="hidden" name="candidateType" value="spt">
                    <input type="hidden" name="electionUUID" value="{{$electionUUID}}">
                    <label for="candidateLevel" class="col-form-label">Image</label>
                    <div class="custom-file mb-3">

                        <input name="candidateImage" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Example: team_strong.png</label>
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
