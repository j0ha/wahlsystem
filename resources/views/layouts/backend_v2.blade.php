<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel')}} Dashboard</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('backend/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
  </head>
  <body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand text-primary" href="#">{{ config('app.name', 'Laravel')}} Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">

                      <li class="nav-item dropdown notification">
                          <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">Elections <i class="fas fa-fw fa-bars"></i></a>
                          <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                              <li>
                                  <div class="notification-title"> Deine Wahlen</div>
                                  <div class="notification-list">
                                      <div class="list-group">
                                          @foreach($electionArray as $e)

                                            <a class="list-group-item list-group-item-action active" href="{{ route('election.Dashboard', ['electionUUID' => $e->uuid]) }}">
                                              <div class="notification-info">
                                                  <div class="notification-list-user-block">
                                                    {{$e->name}}
                                                  </div>
                                              </div>

                                            </a>

                                            @endforeach

                                      </div>
                                  </div>
                              </li>
                              <li>
                                  <div class="list-footer"> <a href="{{route('create.new.election')}}">Neue Wahl erstellen</a></div>
                              </li>
                          </ul>
                      </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('backend/images/avatar-1.jpg')}}" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{$user->name.', '.$user->surname}} </h5>
                                </div>
                                <a class="dropdown-item" href="{{route('profile.Data')}}"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark" style="overflow-y: scroll;">
            <div class="menu-list" style="overflow-y: scroll;">
                <nav class="navbar navbar-expand-lg navbar-light" style="overflow-y: scroll;">
                    <div class="collapse navbar-collapse" id="navbarNav" style="overflow-y: scroll;">
                        <ul class="navbar-nav flex-column">
                          @if(!empty($electionUUID))
                          <li class="nav-divider">
                                Allgemeines
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.Dashboard', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fa-chart-pie"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.Informations', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fa-info"></i>Basic-Informations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.Helper', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fa-hands-helping"></i>Wahlhelfer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.terminals.overview', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fas fa-desktop"></i>Terminals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.schoolclasses.overview', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fa-book"></i>Classes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.schoolgrades.overview', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fa-address-card"></i>Forms</a>
                            </li>
                            @if($user->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.securityreporter', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fas fa-lock"></i>Security reporter</a>
                            </li>
                            @endif

                            @if(\App\Election::where('uuid', $electionUUID)->firstOrFail()->manual_voter_activation == 1)

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.voteractivator', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fas fa-shekel-sign"></i>Voter activator</a>
                            </li>
                            @endif
                          <li class="nav-divider">
                                Wahlsteuerung
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.Controlling', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fa-power-off"></i>Controlling</a>
                            </li>

                            @if($status == 'ended')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('election.evaluation', ['electionUUID' => $electionUUID])}}"><i class="fas fa-fw fa-balance-scale"></i>Evaluation</a>
                            </li>
                            @endif
                            <!--
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-fw fa-chart-line"></i>Prediction</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="">Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">Create external link</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            -->
                                @if($status == 'waiting')
                          <li class="nav-divider">
                                Inhaltsverwaltung
                            </li>

                            <!-- ============================================================== -->
                            <!-- VOTER MENUE -->
                            <!-- ============================================================== -->

                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-fw fa-child"></i>Voters</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('voters.view', ['electionUUID' => $electionUUID])}}">Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('voters.add.single', ['electionUUID' => $electionUUID])}}">Add Single</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('voters.add.many', ['electionUUID' => $electionUUID])}}">Upload File</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- ============================================================== -->
                            <!-- CANDIDATE MENUE FOR SSPW -->
                            <!-- ============================================================== -->

                            <?php // TODO: HIER MÜSSEN WIR NOCH DIE VARIABLE ÜBERGEBEN WELCHE ART VON ELECTION ES IST UM RICHTIG ZUZUORDNEN ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-question"></i>Candidates</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('candidates.view', ['electionUUID' => $electionUUID])}}">Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('candidates.add.single', ['electionUUID' => $electionUUID])}}">Add Single</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif
                              <!--End If für die Frage ob eine Election UUID vorhanden ist-->
                            @endif





                        </ul>
                    </div>
                </nav>
                <div style="position: absolute; bottom: 7%; left: 4%;">
                    <a href="{{route('impressum')}}">Impressum</a> - Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>
                </div>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                  @yield('backendcontent')
                </div>
            </div>

            @if(empty($electionUUID))
            <div class="alert alert-danger" role="alert">
                  You do not have selected an election at the moment. Firstly select your election or create a new one to have access to the dashboard.
            </div>
            @endif
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{asset('backend/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{asset('backend/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- main js -->
    <script src="{{asset('backend/libs/js/main-js.js')}}"></script>
    <!-- chart chartist js -->
    <script src="{{asset('backend/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
    <!-- sparkline js -->
    <script src="{{asset('backend/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
    <!-- morris js -->
    <script src="{{asset('backend/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{asset('backend/vendor/charts/morris-bundle/morris.js')}}"></script>

    @yield('scripts')

    <!-- chart c3 js -->
    <script src="{{asset('backend/vendor/charts/c3charts/c3.min.js')}}"></script>
    <script src="{{asset('backend/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
    <script src="{{asset('backend/vendor/charts/c3charts/C3chartjs.js')}}"></script>
    <script src="{{asset('backend/libs/js/dashboard-ecommerce.js')}}"></script>
    <livewire:scripts>
  </body>

</html>
