<div>
        <div class="influence-finder">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                    <input type="text" wire:model="search_url" wire:keydown.enter="search()" id="search" class="form-control form-control-lg" placeholder="Direct link" @if($state != 'allow') autofocus="autofocus" @endif>
                                    <button wire:click="search()" class="btn btn-primary search-btn">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12">
                        @if($state == 'allow')
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="pl-xl-3">
                                            <div class="m-b-0">
                                                <div class="user-avatar-name d-inline-block">
                                                    <h2 class="font-28 m-b-10">{{$voter->name}} {{$voter->surname}}</h2>
                                                </div>

                                            </div>
                                            <div class="user-avatar-address ">
                                                @php
                                                    $formName = App\Form::where('id', $voter->form_id)->get('name');
                                                    $className = App\Schoolclass::where('id', $voter->schoolclass_id)->get('name');
                                                @endphp
                                                <p class="mb-2"><b>Klasse: </b>{{$className[0]->name}}<span class="m-l-10"><b>Jahrgang: </b>{{$formName[0]->name}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="float-xl-right float-none mt-xl-0 mt-4">
                                            <button wire:click="activate('{{$voter->uuid}}')" onclick="focusMethod()" class="btn btn-success">Activate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($state == 'voted')
                            <div class="card bg-danger-light">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="pl-xl-3">
                                                <div class="m-b-0">
                                                    <div class="user-avatar-name d-inline-block">
                                                        <h2 class="font-28 m-b-10">{{$voter->name}} {{$voter->surname}} <b class="text-danger">Already voted @if($voter->voted_via_terminal)via terminal @elseif($voter->voted_via_email) via direct @endif</b></h2>
                                                    </div>

                                                </div>
                                                <div class="user-avatar-address ">
                                                    @php
                                                        $formName = App\Form::where('id', $voter->form_id)->get('name');
                                                        $className = App\Schoolclass::where('id', $voter->schoolclass_id)->get('name');
                                                    @endphp
                                                    <p class="mb-2"><b>Klasse: </b>{{$className[0]->name}}<span class="m-l-10"><b>Jahrgang: </b>{{$formName[0]->name}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="float-xl-right float-none mt-xl-0 mt-4">
                                                <button onclick="resetMethod()" class="btn btn-success">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card bg-danger-light">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="pl-xl-3">
                                                <div class="m-b-0">
                                                    <div class="user-avatar-name d-inline-block">
                                                        <h2 class="font-28 m-b-10">User not found</h2>
                                                    </div>

                                                </div>
                                                <div class="user-avatar-address ">

                                                    <p class="mb-2"><b></b><span class="m-l-10"><b></b></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="float-xl-right float-none mt-xl-0 mt-4">
                                                <button onclick="resetMethod()" class="btn btn-success">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="font-16" id="demo">Wahldaten</h3>
                                <p><b>Name: </b>{{$election->name}}</p>
                                <p><b>Description: </b>{{$election->description}}</p>
                                <p><b>Status: </b>@if($election->status == config('votestates.waiting.short'))
                                    <span class="badge badge-light">Waiting</span>
                                @endif
                                @if($election->status == config('votestates.planed.short'))
                                   <span class="badge badge-primary">Planned</span>
                                @endif
                                @if($election->status == config('votestates.live.short'))
                                   <span class="badge badge-success">Live</span>
                                @endif
                                @if($election->status == config('votestates.ended.short'))
                                    <span class="badge badge-danger">Ended</span>
                                    @endif</p>
                            </div>
                        </div>
                        <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Voters</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{$stat_voter}}</h1>
                            </div>
                        </div>
                    </div>
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body">
                                <h5 class="text-muted">Active voters</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{$stat_active_voters}}</h1>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                    <span class="ml-1">{{round($stat_active_voters/$stat_voter, 2)*100}}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body">
                                <h5 class="text-muted">Voter outcome</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{$stat_outcome}}</h1>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                    <span class="ml-1">{{round($stat_outcome/$stat_voter, 2)*100}}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script type="text/javascript">
        focusMethod = function work() {
            document.getElementById("search").focus();
        }

        resetMethod = function work() {
            document.getElementById('search').value = '';
            document.getElementById("search").focus();
        }
    </script>
</div>
