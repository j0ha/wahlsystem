@extends('layouts.backend_v2')

@section('backendcontent')
  <div class="row">

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Status</h5>
                <div class="metric-value d-inline-block">
                    @if($selectedE[0]->status == config('votestates.waiting.short'))
                        <h1><span class="badge badge-light px-4 py-4">Waiting</span></h1>
                    @endif
                    @if($selectedE[0]->status == config('votestates.planned.short'))
                        <h1><span class="badge badge-primary px-4 py-4">Planned</span></h1>
                    @endif
                    @if($selectedE[0]->status == config('votestates.live.short'))
                        <h1><span class="badge badge-success px-xl-5 py-3">Live</span></h1>
                    @endif
                    @if($selectedE[0]->status == config('votestates.ended.short'))
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
                <h5 class="card-title border-bottom">Status:</h5>
                <p class="card-text"><span class="badge badge-light">Waiting</span>
                    <br>The election has been created and could be possibly started now. Voting is not possible at this status.</p>
                <p class="card-text"><span class="badge badge-primary">Planned</span>
                    <br>The election is planned and will start at your startpoint and end at your endingpoint. During the preparing status its not possible to change the election anymore. To vote is not possible at the moment.</p>
                <p class="card-text"><span class="badge badge-success">Live</span>
                    <br>The election is now active and can not be changed anymore. Voting is now possible.</p>
                <p class="card-text"><span class="badge badge-danger">Ended</span>
                    <br>The election has been ended and can not be changed. It could not be voted anymore</p>
            </div>
        </div>
    </div>
  </div>






  <!-- Infocard - What is the status of the election -->

  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="modal">
            <h3 class="section-title">Change mode</h3>
            <p>Change the mode of the survey</p>
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
                @if(\Session::has('activeError'))
                    <span class="error text-danger">{{\Session::get('activeError')}}</span>
                @endif

                @if($selectedE[0]->activeby != null OR $selectedE[0]->activeto != null)
                    <div class="alert alert-secondary mt-3" role="alert">
                        @php
                            \Carbon\Carbon::setToStringFormat('jS \o\f F, Y g:i:s a');
                        @endphp
                        The election will be set <span class="badge badge-success">live</span> at the {{$selectedE[0]->activeby}} <br>
                        The election will be set <span class="badge badge-danger">ended</span> at the {{$selectedE[0]->activeto}}
                    </div>
                @endif
            </div>
        </div>
    </div>
  </div>




  <!-- Infocard - What is the status of the election -->

  <div class="card">
      <h5 class="card-header">Set end</h5>
      <div class="card-body">
            <div class="">
                    <h4>End survery</h4>
                    <!-- Button trigger modal -->
                    @if($selectedE[0]->status == "live")
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#changetoend">End now</a>
                    @else
                    <a href="" class="btn btn-primary disabled" data-toggle="modal" data-target="#changetoend">End now</a>
                    @endif

            </div>
      </div>
  </div>



  <!-- Infocard - What is the status of the election -->

  <div class="card">
      <h5 class="card-header">Evaluate</h5>
            <div class="card-body">
                <div class="">
                    <h4>End Survey</h4>
                    <!-- Button trigger modal -->
                    @if($selectedE[0]->status == "ended")
                    <a href="{{route('election.evaluation', ['electionUUID' => $selectedE[0]->uuid])}}" class="btn btn-primary">Show evaluation</a>
{{--                    <a href="" class="btn btn-primary">Download evaluation</a>--}}
                    @else
                    <a href="" class="btn btn-primary disabled" >Show evaluation</a>
{{--                    <a href="" class="btn btn-primary disabled" >Download evaluation</a>--}}
                    @endif
                </div>
            </div>
  </div>

  <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="section-block" id="modal">
              <h3 class="section-title">E-Mail Controll</h3>
              <p>Controll the E-Mail service</p>
          </div>
          <div class="card">
              <h5 class="card-header">Send tool</h5>
              <div class="card-body">
                  <div class="">
                      <h4>Send E-Mail invitations to every voter</h4>
                      <a href="" class="btn btn-primary @if($selectedE[0]->email_sendtime != null AND $selectedE[0]->email_terminal != null) disabled @endif" data-toggle="modal" data-target="#sendnow">Send now</a>
                      <a href="" class="btn btn-primary @if($selectedE[0]->email_sendtime != null AND $selectedE[0]->email_terminal != null) disabled @endif" data-toggle="modal" data-target="#sendplan">Plan a timetable</a>
                  </div>
                  @if(\Session::has('emailError'))
                      <span class="error text-danger">{{\Session::get('emailError')}}</span>
                  @endif
                  @if($selectedE[0]->email_sendtime != null OR $selectedE[0]->email_terminal != null)
                  <div class="alert alert-secondary mt-3" role="alert">
                      @php
                            \Carbon\Carbon::setToStringFormat('jS \o\f F, Y g:i:s a');
                      @endphp
                      The scheduler is set to the {{$selectedE[0]->email_sendtime}}.
                  </div>
                  @endif
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
                <h5 class="modal-title" id="changetoactiveLabel">Activate now</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <p>Do you really want to activate the election?</p>
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
                <p>Do you really want to plan the election for the following time?</p>
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
                <a href="" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                <button class="btn btn-primary">Plan!</button>
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
                <p>Do you really want to end the election?</p>
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

  <div class="modal fade" id="sendnow" tabindex="-1" role="dialog" aria-labelledby="changetoactiveLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="changetoactiveLabel">Send now</h5>
                  <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </a>
              </div>
              <div class="modal-body">
                  <p>Do you really want to send an email to all voters?</p>
              </div>
              <div class="modal-footer">

                  <form action="{{route('e.email')}}" method="post">
                      @csrf
                      @if($terminals)
                          <div class="form-group">
                              <label for="input-select">E-Mail Terminal</label>
                              <select name="terminalUUID" class="form-control" id="input-select">
                                  <option>Choose Terminal for E-Mail sending</option>
                                  @foreach($terminals as $terminal)
                                      <option value="{{$terminal->uuid}}">{{$terminal->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      @endif
                      <div class="form-group">
                          <button class="btn btn-primary">Send</button>
                          <a href="" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                      </div>
                      <input type="hidden" name="eUUID" value="{{$selectedE[0]->uuid}}">
                  </form>

              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="sendplan" tabindex="-1" role="dialog" aria-labelledby="changetoactiveplanLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="changetoactiveplanLabel">Activate now</h5>
                  <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </a>
              </div>
              <div class="modal-body">
                  <p>Do you really want to plan the election for the following time?</p>
                  <form class="" action="{{route('e.planEmail')}}" method="post">
                      @csrf
                      @if($terminals != null)
                          <div class="form-group">
                              <label for="input-select">E-Mail Terminal</label>
                              <select name="terminalUUID" class="form-control" id="input-select">
                                  <option value="">Choose Terminal for E-Mail sending</option>
                                  @foreach($terminals as $terminal)
                                      <option value="{{$terminal->uuid}}">{{$terminal->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      @endif
                      <div class="form-group">
                          <label for="inputText6" class="col-form-label">Send-Time</label>
                          <input name="starttimeEmail" type="datetime-local" class="form-control">
                          <input type="hidden" name="eUUID" value="{{$selectedE[0]->uuid}}">
                      </div>


              </div>
              <div class="modal-footer">
                  <a href="" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                  <button class="btn btn-primary">Plan</button>
                  </form>
              </div>
          </div>
      </div>
  </div>



@endsection
