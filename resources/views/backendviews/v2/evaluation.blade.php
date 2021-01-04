@extends('layouts.backend_v2')

@section('backendcontent')


    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Number of Voters</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{$number_voters}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Number of unpolled Voters</h5>
                    <div class="metric-value d-inline-block">

                        <h1 class="mb-1">{{$number_voters_unpolled}}</h1>

                    </div>
                </div>
            </div>
        </div>
        @if($abstention == 1)
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Number of abstentions</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{$number_abstention}}</h1>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Number of participation in %</h5>
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
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <h4 class="card-header text-center">Votedistribution Candidates</h4>
                <div class="card-body">
                    <div id="votedistribution"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Voterdistribution by Terminals</h5>
                <div class="card-body">
                    <div id="terminal_usage_dounut"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Voterdistribution by forms</h5>
                <div class="card-body">
                    <div id="jahrgang_dounut"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Turnout by classes in %</h5>
                <div class="card-body">
                    <div id="klassenwahlbeteiligung_bar"></div>
                </div>
            </div>
        </div>
    </div>






@endsection

@section('scripts')
    <script type="text/javascript">
        new Morris.Bar({
            element: 'votedistribution',
            data: [
                @foreach($votedistribution_candidates as $distribution)
                { y: {{$distribution->votes}}, x: '{{$distribution->name}}' },
                @endforeach
            ],
            xkey: 'x',
            ykeys: ['y'],
            labels: ['Value'],
            barColors: ['#FF8000'],
            resize: true,
            gridTextSize: '20px'

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
            labels: ['Participation (%)'],
            barColors: ['#5969ff'],
            resize: true,
            gridTextSize: '14px'

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

    </script>
@endsection