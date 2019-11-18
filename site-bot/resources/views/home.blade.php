@extends('layouts.menu')

@section('content')
    <h5>Statistiques & Informations</h5>
<div class="row">
    <div class="col-xl-8">
        <div class="row mb-4">
            {{--Ligne stats--}}
            <div class="col-md-4">
                {{--Nombre de question--}}
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Questions ajoutées</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$stats["nbQuest"]}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-question fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                {{--Nombre de partie--}}
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Partie jouée</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$stats["nbGame"]}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                {{--Nombre de joueur unique--}}
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Joueur unique</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$stats["nbJoueurs"]}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{--Repartition question--}}
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Type de question</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="myPieChart" width="778" height="312" class="chartjs-render-monitor" style="display: block; height: 208px; width: 519px;"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                <span class="mr-2">
                  <i class="fas fa-circle text-primary"></i> QCM
                    <input type="hidden" id="cpt_qcm" value="{{$stats['cpt']['qcm']}}">
                </span>
                            <span class="mr-2">
                  <i class="fas fa-circle text-success"></i> Image
                                <input type="hidden" id="cpt_image" value="{{$stats['cpt']['image']}}">
                </span>
                            <span class="mr-2">
                  <i class="fas fa-circle text-info"></i> Ouverte
                                <input type="hidden" id="cpt_simple" value="{{$stats['cpt']['simple']}}">
                </span>
                        </div>
                    </div>
                </div>
            </div>
            {{--Etat--}}
            <div class="col-md-6">
                @if($stats['cGame'])
                    <div class="card bg-success text-white shadow mb-3">
                        <div class="card-body">
                            Partie en cours !
                            <div class="text-white-50 small">{{$stats['cGame']->nom}} <a class="stretched-link text-white font-weight-bold" href="/game/current">Reprendre</a></div>
                        </div>
                    </div>
                @else
                    <div class="card bg-info text-white shadow mb-3">
                        <div class="card-body">
                            Aucun Roazhon Wall en cours
                            <div class="text-white-50 small"><a class="stretched-link text-white font-weight-bold" href="/game/current">Commencer !</a></div>
                        </div>
                    </div>
                @endif
                <div class="card mb-4 mt-3">
                    <div class="card-header">
                        Work in progress
                    </div>
                    <div class="card-body">
                        <p>Les éléments visibles sont susceptibles d'être changés ou modifié.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Top Joueur--}}
    <div class="col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Top Joueur</h6>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table table-bordered" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Rang</th>
                            <th>Pseudo</th>
                            <th>Score</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stats['leaderBoard'] as $player)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$player->pseudo}}</td>
                                <td>{{$player->score}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{URL::asset("js/general.js")}}"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-locale-fr-latest.js"></script>
@endsection
