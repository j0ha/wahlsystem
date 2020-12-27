@extends('layouts.backend_v2')

@section('backendcontent')
  <div class="row">

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Status</h5>
                <div class="metric-value d-inline-block">
                    @if($selectedE[0]->status == "waiting")
                        <h1><span class="badge badge-light px-4 py-4">Waiting</span></h1>
                    @endif
                    @if($selectedE[0]->status == "planned")
                        <h1><span class="badge badge-primary px-4 py-4">Planned</span></h1>
                    @endif
                    @if($selectedE[0]->status == "live")
                        <h1><span class="badge badge-success px-xl-5 py-3">Live</span></h1>
                    @endif
                    @if($selectedE[0]->status == "ended")
                        <h1><span class="badge badge-danger px-4 py-4">Ended</span></h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
      <!-- Infocard - What is the status of the election -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="card-title border-bottom">Status-Möglichkeiten:</h5>
                <p class="card-text"><span class="badge badge-light">Waiting</span>
                    <br>Die Wahl ist erstellt und kann nun gestartet werden. Das Abstimmen ist zu diesem Zeitpunkt noch nicht möglich.</p>
                <p class="card-text"><span class="badge badge-primary">Planned</span>
                    <br>Die Wahl ist geplant zu einem bestimmten Zeitpunkt zu starten bzw. zu enden und kann während der Vorbereitungsphase noch verändert werden. Eine Abstimmung ist zu diesem Zeitpunkt noch nicht freigeschaltet.</p>
                <p class="card-text"><span class="badge badge-success">Live</span>
                    <br>Die Wahl ist aktiv und kann nicht mehr verändert werden. Das Abstimmen ist von diesem Zeitpunkt aus möglich.</p>
                <p class="card-text"><span class="badge badge-danger">Ended</span>
                    <br>Die Wahl ist beendet und kann nicht verändert werden. Eine Abstimmung ist nicht mehr möglich. Die Auswertung lässt sich abrufen.</p>
            </div>
        </div>
    </div>
  </div>






  <!-- Infocard - What is the status of the election -->

  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="modal">
            <h3 class="section-title">Modus steuern</h3>
            <p>Den Status der Wahl steuern</p>
        </div>
        <div class="card">
            <h5 class="card-header">Activating tool</h5>
            <div class="card-body">
                <div class="">
                    <h4>Activate the election</h4>
                    <!-- Button trigger modal -->
                    @if($selectedE[0]->status == "waiting")
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#changetoactive">Activate now</a>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#changetoactiveplan">Plan a timetable</a>
                    @else
                    <a href="" class="btn btn-primary disabled" data-toggle="modal" data-target="#changetoactive">Activate now</a>
                    <a href="" class="btn btn-primary disabled" data-toggle="modal" data-target="#changetoactiveplan">Plan a timetable</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
  </div>




  <!-- Infocard - What is the status of the election -->

  <div class="card">
      <h5 class="card-header">Beenden</h5>
      <div class="card-body">
            <div class="">
                    <h4>Wahl beenden</h4>
                    <!-- Button trigger modal -->
                    @if($selectedE[0]->status == "live")
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#changetoend">Jetzt beenden</a>
                    @else
                    <a href="" class="btn btn-primary disabled" data-toggle="modal" data-target="#changetoend">Jetzt beenden</a>
                    @endif

            </div>
      </div>
  </div>



  <!-- Infocard - What is the status of the election -->

  <div class="card">
      <h5 class="card-header">Auswertung</h5>
            <div class="card-body">
                <div class="">
                    <h4>Wahl beenden</h4>
                    <!-- Button trigger modal -->
                    @if($selectedE[0]->status == "ended")
                    <a href="" class="btn btn-primary">Auswertung anzeigen</a>
                    <a href="" class="btn btn-primary">Auswertung downloaden</a>
                    @else
                    <a href="" class="btn btn-primary disabled" >Auswertung anzeigen</a>
                    <a href="" class="btn btn-primary disabled" >Auswertung downloaden</a>
                    @endif
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
                <h5 class="modal-title" id="changetoactiveLabel">Activate now</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Möchtest du die Wahl wirklich aktivieren?</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Break</a>
                <form action="{{route('e.activate')}}" method="post">
                    @csrf
                    <button class="btn btn-primary">Activate</button>
                    <input type="hidden" name="eUUID" value="{{$selectedE[0]->uuid}}">
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changetoactiveplan" tabindex="-1" role="dialog" aria-labelledby="changetoactiveplanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changetoactiveplanLabel">Activate now</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Möchtest du die Wahl wirklich für folgende Zeit planen?</p>
                <form class="" action="{{route('e.activateWithTime')}}" method="post">
                    @csrf
                  <div class="form-group">
                      <label for="inputText6" class="col-form-label">Start</label>
                      <input name="starttime" type="datetime-local" class="form-control">
                      <label for="inputText6" class="col-form-label">End</label>
                      <input name="endtime" type="datetime-local" class="form-control">
                      <input type="hidden" name="eUUID" value="{{$selectedE[0]->uuid}}">
                  </div>


            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Abbrechen</a>
                <button class="btn btn-primary">Planen</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changetoend" tabindex="-1" role="dialog" aria-labelledby="changetoendLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changetoendLabel">End now</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Möchtest du die Wahl wirklich beenden?</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Break</a>
                <form action="{{route('e.end')}}" method="post">
                    @csrf
                    <button class="btn btn-primary">End up</button>
                    <input type="hidden" name="eUUID" value="{{$selectedE[0]->uuid}}">
                </form>



            </div>
        </div>
    </div>
</div>

@endsection
