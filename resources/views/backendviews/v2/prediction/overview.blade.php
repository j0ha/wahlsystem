@extends('layouts.backend_v2')

@section('backendcontent')


<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Nutzer*innen</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">21322</h1>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Fragen</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">12</h1>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Gezählte Stimmen</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">213442</h1>
              </div>
          </div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
      <div class="card border-3 border-top border-top-primary">
          <div class="card-body">
              <h5 class="text-muted">Wahlbeteiligung</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">23%</h1>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Stimmenverteilung Jahrgänge</h5>
          <div class="card-body">
              <div id="voters_forms"></div>
          </div>
      </div>
  </div>
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">Stimmenverteilung</h5>
          <div class="card-body">
              <div id="votes_dounut"></div>
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
            { value: 40, label: 'Peter 1' },
            { value: 20, label: 'Peter 2' },
            { value: 40, label: 'Peter 3' }
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

    new Morris.Donut({
        element: 'votes_dounut',
        data: [
            { value: 60, label: 'Team 1' },
            { value: 30, label: 'Team 2' },
            { value: 10, label: 'Team 3' }
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
        element: 'voters_forms',
        data: [
            { x: '2011 Q1', y: 3, z: 2, a: 3 },
            { x: '2011 Q2', y: 2, z: null, a: 1 },
            { x: '2011 Q3', y: 0, z: 2, a: 4 },
            { x: '2011 Q4', y: 2, z: 4, a: 3 }
        ],
        xkey: 'x',
        ykeys: ['y', 'z', 'a'],
        labels: ['Y', 'Z', 'A'],
        stacked: true,
           barColors: ['#5969ff', '#ff407b', '#25d5f2'],
             resize: true,
                gridTextSize: '14px'
    });
</script>
@endsection
