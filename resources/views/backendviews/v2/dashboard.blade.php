@extends('layouts.backend_v2')

@section('backendcontent')


<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Users</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">{{$stat_voters}}</h1>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Questions</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">{{$stat_questions}}</h1>
              </div>
          </div>
      </div>
  </div>
  @if($statistics_boolean == 1)
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Counted votes</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">{{$stat_votes}}</h1>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Turnout</h5>
              <div class="metric-value d-inline-block">
                  @if($stat_votes AND $stat_voters)
                    <h1 class="mb-1">{{round($stat_votes/$stat_voters*100,3)}}%</h1>
                    @else
                    <h1 class="mb-1">0%</h1>
                    @endif
              </div>
          </div>
      </div>
  </div>
    @endif
</div>

<div class="row">
  <div class="col-xl-18 col-lg-12 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Terminals</h5>
          <div class="card-body p-0">
              <div class="table-responsive">
                  <table class="table">
                      <thead class="bg-light">
                          <tr class="border-0">
                              <th class="border-0">#</th>
                              <th class="border-0">Name</th>
                              <th class="border-0">Location</th>
                              <th class="border-0">Start Time</th>
                              <th class="border-0">End Time</th>
                              <th class="border-0">IP-Restriction</th>
                              <th class="border-0">Status</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($stat_terminals as $terminal)
                          <tr>
                              <td>1</td>
                              <td>{{$terminal->name}}</td>
                              <td>{{$terminal->position}} </td>
                              <td>@if($terminal->start_time){{$terminal->start_time}}@else <span class="badge badge-pill badge-light mx-1">not defined</span> @endif</td>
                              <td>@if($terminal->end_time){{$terminal->end_time}}@else <span class="badge badge-pill badge-light mx-1">not defined</span> @endif</td>
                              <td>@if($terminal->ip_restriction){{$terminal->ip_restriction}}@else<span class="badge badge-pill badge-light mx-1">Inactive</span>@endif</td>
                              <td>@if($terminal->status == 1)<span class="badge badge-pill badge-success mx-1">Active</span>@else<span class="badge badge-pill badge-danger mx-1">Inactive</span>@endif</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@if($statistics_boolean == 1)
<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Terminal Usage</h5>
          <div class="card-body">
              <div id="terminal_usage_dounut"></div>
          </div>
      </div>
  </div>
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Turnout per class in %</h5>
          <div class="card-body">
              <div id="klassenwahlbeteiligung_bar"></div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Student greade spread</h5>
          <div class="card-body">
              <div id="jahrgang_dounut"></div>
          </div>
      </div>
  </div>

  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Student class spread</h5>
          <div class="card-body">
              <div id="klassenverteilung_bar"></div>
          </div>
      </div>
  </div>
</div>
@endif





@endsection

@section('scripts')
<script type="text/javascript">
    new Morris.Donut({
        element: 'jahrgang_dounut',
        data: [
          @foreach($stat_formVoterSpread as $f_stat)
            { value: {{$f_stat[1]}}, label: '{{$f_stat[0]}}' },
          @endforeach
        ],

        labelColor: '#2e2f39',
           gridTextSize: '14px',
        colors: [
             "#5969ff",
                        "#ff407b",
                        "#25d5f2",
                        "#ffc750"

        ],

        formatter: function(x) { return x + "%" },
          resize: true
    });

    new Morris.Donut({
        element: 'terminal_usage_dounut',
        data: [
          @foreach($stat_terminalUsage as $t_stat)
            { value: {{$t_stat[0]}}, label: '{{$t_stat[1]}}' },
          @endforeach

        ],

        labelColor: '#2e2f39',
           gridTextSize: '14px',
        colors: [
             "#5969ff",
                        "#ff407b",
                        "#25d5f2",
                        "#ffc750"

        ],

        formatter: function(x) { return x + "%" },
          resize: true
    });

    new Morris.Bar({
        element: 'klassenverteilung_bar',
        data: [
          @foreach($stat_schoolclassesSpread as $s_stat)
            { y: {{$s_stat[1]}}, x: '{{$s_stat[0]}}' },
          @endforeach
        ],
        xkey: 'x',
        ykeys: ['y'],
        labels: ['Y'],
           barColors: ['#5969ff'],
             resize: true,
                gridTextSize: '14px'

    });

    new Morris.Bar({
        element: 'klassenwahlbeteiligung_bar',
        data: [
          @foreach($stat_schoolclassesVoteTurnout as $sv_stat)
            { y: {{$sv_stat[1]}}, x: '{{$sv_stat[0]}}' },
          @endforeach
        ],
        xkey: 'x',
        ykeys: ['y'],
        labels: ['Y'],
           barColors: ['#5969ff'],
             resize: true,
                gridTextSize: '14px'

    });

</script>
@endsection
