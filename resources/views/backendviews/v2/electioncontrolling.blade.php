@extends('layouts.backend_v2')

@section('backendcontent')
  <div class="row">

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Staus</h5>
                <div class="metric-value d-inline-block">
                    <h1><span class="badge badge-light px-4 py-2" style="font-size: 2em;">Wartend</span></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h3 class="card-title border-bottom">Statussen</h5>
                <p class="card-text"><span class="badge badge-light">Wartend</span>Die Wahl ist erstellt und kann eingestellt werden. Eine Abstimmung ist nicht ferigeschaltet.</p>
                <p class="card-text"><span class="badge badge-primary">Geplant</span>Die Wahl ist geplant und kann eingestellt werden. Eine Abstimmung ist nicht ferigeschaltet.</p>
                <p class="card-text"><span class="badge badge-success">Läuft</span>Die Wahl ist aktiv und kann nicht verändert werden. Eine Abstimmung ist möglich.</p>
                <p class="card-text"><span class="badge badge-danger">Beendet</span>Die Wahl ist beendet und kann nicht verändert werden. Eine Abstimmung ist nicht mehr möglich. Die Auswertung lässt sich abrufen.</p>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="modal">
            <h3 class="section-title">Modus steuern</h3>
            <p>Den Status der Wahl steuern</p>
        </div>
        <div class="card">
            <h5 class="card-header">aktivieren</h5>
            <div class="card-body">
                <div class="">
                    <h4>Wahl akivieren</h4>
                    <!-- Button trigger modal -->
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#changetoactive">Jetzt aktivieren</a>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#changetoactiveplan">Planen</a>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Beenden</h5>
            <div class="card-body">
                <div class="">
                    <h4>Wahl beenden</h4>
                    <!-- Button trigger modal -->
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#changetoend">Jetzt beenden</a>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#changetoendplan">Planen</a>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Auswerten</h5>
            <div class="card-body">
                <div class="">
                    <h4>Wahl beenden</h4>
                    <!-- Button trigger modal -->
                    <a href="#" class="btn btn-primary">Auswertung anzeigen</a>
                    <a href="#" class="btn btn-primary">Auswertung downloaden</a>
                </div>
            </div>
        </div>
    </div>

    </div>
  </div>


<!-- Modals -->
<div class="modal fade" id="changetoactive" tabindex="-1" role="dialog" aria-labelledby="changetoactiveLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changetoactiveLabel">Jetzt aktivieren</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Möchtest du die Wahl wirklich aktivieren?</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Abbrechen</a>
                <a href="#" class="btn btn-primary">Aktivieren</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changetoactiveplan" tabindex="-1" role="dialog" aria-labelledby="changetoactiveplanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changetoactiveplanLabel">Jetzt aktivieren</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Möchtest du die Wahl wirklich für folgende Zeit planen?</p>
                <form class="" action="" method="post">
                  <div class="form-group">
                      <label for="inputText6" class="col-form-label">Startzeit</label>
                      <input id="inputText6" type="datetime" class="form-control">
                  </div>


            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Abbrechen</a>
                <a href="#" class="btn btn-primary">Planen</a>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changetoend" tabindex="-1" role="dialog" aria-labelledby="changetoendLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changetoendLabel">Jetzt beenden</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Möchtest du die Wahl wirklich beenden?</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Abbrechen</a>
                <a href="#" class="btn btn-primary">Beenden</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changetoendplan" tabindex="-1" role="dialog" aria-labelledby="changetoendplanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changetoendplanLabel">Jetzt beenden</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Möchtest du die Wahl wirklich für folgende Zeit planen zu beenden?</p>
                <form class="" action="" method="post">
                  <div class="form-group">
                      <label for="inputText6" class="col-form-label">Endzeit</label>
                      <input id="inputText6" type="datetime" class="form-control">
                  </div>


            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Abbrechen</a>
                <a href="#" class="btn btn-primary">Planen</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
