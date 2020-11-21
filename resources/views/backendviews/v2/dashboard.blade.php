@extends('layouts.backend_v2')

@section('backendcontent')


<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Nutzer*innen</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">{{$stat_voters}}</h1>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Fragen</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">{{$stat_questions}}</h1>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Gezählte Stimmen</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">{{$stat_votes}}</h1>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Wahlbeteiligung</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">{{round($stat_votes/$stat_voters*100,3)}}%</h1>
              </div>
          </div>
      </div>
  </div>
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
                              <th class="border-0">Ort</th>
                              <th class="border-0">Start Zeit</th>
                              <th class="border-0">End Zeit</th>
                              <th class="border-0">IP-Beschränkung</th>
                              <th class="border-0">Status</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($stat_terminals as $terminal)
                          <tr>
                              <td>1</td>
                              <td>{{$terminal->name}}</td>
                              <td>{{$terminal->position}} </td>
                              <td>@if($terminal->start_time){{$terminal->start_time}}@else <span class="badge badge-pill badge-light mx-1">nicht festgelegt</span> @endif</td>
                              <td>@if($terminal->end_time){{$terminal->end_time}}@else <span class="badge badge-pill badge-light mx-1">nicht festgelegt</span> @endif</td>
                              <td>@if($terminal->ip_restriction){{$terminal->ip_restriction}}@else<span class="badge badge-pill badge-light mx-1">Deaktiv</span>@endif</td>
                              <td>@if($terminal->status == 1)<span class="badge badge-pill badge-success mx-1">Aktiv</span>@else<span class="badge badge-pill badge-danger mx-1">Deaktiv</span>@endif</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Nutzungsverteilung der Terminals</h5>
          <div class="card-body">
              <div id="terminal_usage_dounut"></div>
          </div>
      </div>
  </div>
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Wahlbeteiligung Klassen</h5>
          <div class="card-body">
              <div id="klassenwahlbeteiligung_bar"></div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Nutzerverteilung</h5>
          <div class="card-body">
              <div id="jahrgang_dounut"></div>
          </div>
      </div>
  </div>

  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Klassenverteilung</h5>
          <div class="card-body">
              <div id="klassenverteilung_bar"></div>
          </div>
      </div>
  </div>
</div>






@endsection

@section('scripts')
<script type="text/javascript">
    new Morris.Donut({
        element: 'jahrgang_dounut',
        data: [
            { value: 12, label: 'Jahrgang 1' },
            { value: 31, label: 'Jahrgang 2' },
            { value: 31, label: 'Jahrgang 23' },
            { value: 23, label: 'Jahrgang 123' }
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
            { x: '11b', y: 10 },
            { x: '11b', y: 10 },
            { x: '11b', y: 11 },
            { x: '11b', y: 2 },
            { x: '11b', y: 32 },
            { x: '11b', y: 14 },
            { x: '11b', y: 15 },
            { x: '11b', y: 26 },
            { x: '11b', y: 37 },
            { x: '11b', y: 10 },
            { x: '11b', y: 11 },
            { x: '11b', y: 2 },
            { x: '11b', y: 32 },
            { x: '11b', y: 14 },
            { x: '11b', y: 15 },
            { x: '11b', y: 26 },
            { x: '11b', y: 37 },
            { x: '11b', y: 11 },
            { x: '11b', y: 37 },
            { x: '11b', y: 11 },
            { x: '11b', y: 2 },
            { x: '11b', y: 32 },
            { x: '11b', y: 14 },
            { x: '11b', y: 15 },
            { x: '11b', y: 2 },
            { x: '11b', y: 32 },
            { x: '11b', y: 14 },
            { x: '11b', y: 15 },
            { x: '11b', y: 26 },
            { x: '11b', y: 37 },
            { x: '11b', y: 8 }
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
            { x: '11b', y: 10 },
            { x: '11b', y: 10 },
            { x: '11b', y: 11 },
            { x: '11b', y: 2 },
            { x: '11b', y: 32 },
            { x: '11b', y: 14 },
            { x: '11b', y: 15 },
            { x: '11b', y: 26 },
            { x: '11b', y: 37 },
            { x: '11b', y: 10 },
            { x: '11b', y: 11 },
            { x: '11b', y: 2 },
            { x: '11b', y: 32 },
            { x: '11b', y: 14 },
            { x: '11b', y: 15 },
            { x: '11b', y: 26 },
            { x: '11b', y: 37 },
            { x: '11b', y: 11 },
            { x: '11b', y: 37 },
            { x: '11b', y: 11 },
            { x: '11b', y: 2 },
            { x: '11b', y: 32 },
            { x: '11b', y: 14 },
            { x: '11b', y: 15 },
            { x: '11b', y: 2 },
            { x: '11b', y: 32 },
            { x: '11b', y: 14 },
            { x: '11b', y: 15 },
            { x: '11b', y: 26 },
            { x: '11b', y: 37 },
            { x: '11b', y: 8 }
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
