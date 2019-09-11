@extends('layouts.menu')

@section('content')
    <h5>Statistiques & Informations</h5>
<div class="row">
    <div class="col-8">
        <div class="row mb-4">
            {{--Ligne stats--}}
            <div class="col-4">
                {{--Nombre de question--}}
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Questions ajoutées</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-question fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                {{--Nombre de partie--}}
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Partie jouée</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                {{--Nombre de joueur unique--}}
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Joueur unique</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
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
            <div class="col-6">
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
                </span>
                            <span class="mr-2">
                  <i class="fas fa-circle text-success"></i> Image
                </span>
                            <span class="mr-2">
                  <i class="fas fa-circle text-info"></i> Ouverte
                </span>
                        </div>
                    </div>
                </div>
            </div>
            {{--Etat--}}
            <div class="col-6">
                <div class="card bg-secondary text-white shadow mb-3">
                    <div class="card-body">
                        Aucun Roazhon Wall en cours
                        <div class="text-white-50 small">#4e73df</div>
                    </div>
                </div>
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                        Roazhon Wall du 06/08/2019
                        <div class="text-white-50 small">
                            <span>Joueurs</span><span class="badge badge-danger badge-counter ml-1">247</span>
                            <span class="ml-2">Durée</span><span class="badge badge-danger badge-counter ml-1">0:53</span>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mt-3">
                    <div class="card-header">
                        Work in progress
                    </div>
                    <div class="card-body">
                        <p>Actuellement, le site n'est pas fonctionnel, seul le template a été implémenté.</p>
                        <p>Les éléments visibles sont susceptibles d'être changés ou modifié.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Top Joueur--}}
    <div class="col-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Top Joueur</h6>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table table-bordered" id="dataTable"  cellspacing="0">
                        <thead>
                        <tr>
                            <th>Rang</th>
                            <th>Pseudo</th>
                            <th>Score</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Arthur</td>
                            <td>253</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Augustin</td>
                            <td>234</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Youtopie</td>
                            <td>128</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Arthur</td>
                            <td>253</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Augustin</td>
                            <td>234</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Youtopie</td>
                            <td>128</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Augustin</td>
                            <td>234</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Youtopie</td>
                            <td>128</td>
                        </tr>
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
