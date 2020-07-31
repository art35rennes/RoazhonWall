@extends("layouts.menu")

@section('topbar')
    <ul class="navbar-nav ml-auto">
        <il class="nav-item">
            <a class="nav-link" href="#Tab1">
                <i class="fas fa-fw fa-paperclip m-1"></i>
                <span>Log & Statistiques</span></a>
        </il>

        <li class="nav-item">
            <a class="nav-link" href="#Tab2">
                <i class="fas fa-fw fa-user m-1"></i>
                <span>Joueurs & Questions</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#cQuestion">
                <i class="fas fa-fw fa-question-circle m-1"></i>
                <span>Question en cours</span></a>
        </li>
    </ul>
@endsection

@section("content")
    <h3 class="mb-5">{{$current->nom}} <a class="btn btn-danger" href="/game/end" id="endGame" role="button">Terminer partie</a></h3>
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <ul class="nav nav-tabs" id="Tab1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="logs-tab" data-toggle="tab" href="#logs" role="tab" aria-controls="logs"
                           aria-selected="true">Log</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="stats-tab" data-toggle="tab" href="#stats" role="tab" aria-controls="questions"
                           aria-selected="false">Statistique</a>
                    </li>
                </ul>
                <div class="tab-content" id="TabPQ">
                    <div class="tab-pane fade show active" id="logs" role="tabpanel" aria-labelledby="logs-tab">
                        <h3>Not implemented yet</h3>
                    </div>
                    <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                        <h3>Not implemented yet</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-7">
                <ul class="nav nav-tabs" id="Tab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="questions-tab" data-toggle="tab" href="#questions" role="tab" aria-controls="questions"
                           aria-selected="false">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="players-tab" data-toggle="tab" href="#players" role="tab" aria-controls="players"
                           aria-selected="true">Joueurs</a>
                    </li>
                </ul>
                <div class="tab-content" id="TabPQ">
                    <div class="tab-pane fade" id="players" role="tabpanel" aria-labelledby="players-tab">
                        <table class="table table-bordered dataTableFull" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Joueur</th>
                                <th class="fit">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <td>{{$player->pseudo}} @if($player->type == "out") <span class="font-weight-light">(éliminé)</span>@endif</td>
                                    <td class="text-center">
                                        @if($player->type != "out")
                                            @if($player->type == "joueur")
                                        <i class="fas fa-crown"></i>
                                            @elseif($player->type == "challenger")
                                        <i class="fas fa-level-down-alt"></i>
                                            @endif
                                        <i class="ml-1 fas fa-ban"></i>
                                        <input type="hidden" value="{{$player->id_player}}">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button id="randomChallenger" class="btn btn-user btn-outline-primary offset-3">Tirer un Challenger au hasard</button>
                    </div>
                    <div class="tab-pane fade show active" id="questions" role="tabpanel" aria-labelledby="questions-tab">
                        <table class="table table-bordered dataTableFull">
                            <thead>
                            <th>Titre</th>
                            <th class="fit">Type</th>
                            <th class="fit">Récurrence</th>
                            <th class="fit">Action</th>
                            </thead>
                            <tbody>
                            @foreach($questions as $key=>$question)
                                <tr @if($question->state > 0) class="bg-success text-white" @endif
                                @if($question->state == -1) class="bg-info text-white" @endif>

                                    <td>{{$question->text}}</td>
                                    <td>
                                        @switch($question->reponses)
                                            @case ("1")
                                            @if($question->image)
                                                Image
                                            @else
                                                Question&nbsp;ouverte
                                            @endif
                                            @break
                                            @default
                                            QCM
                                            @break
                                        @endswitch
                                    </td>
                                    <td>@if($question->frequence != null){{$question->frequence}}@else 0 @endif</td>
                                    <td class="text-center">
                                        @switch($question->state)
                                            @case(0)
                                            <i class="fas fa-play-circle"></i>
                                            @break
                                            @case(-1)
                                            {{--                                TODO JS can be better--}}
                                            <i class="fas fa-forward"></i>
                                            <i class="fas fa-times-circle"></i>
                                            @break
                                            @default
                                            <i class="fas fa-times-circle"></i>
                                        @endswitch
                                        <input type="hidden" value="{{$question->id}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button id="randomQuestion" class="btn btn-user btn-outline-primary offset-3">Tirer une question au hasard</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        @if(isset($cQuestion[0]))
            <div class="card shadow mb-4 col-12" id="cQuestion">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Question en cours | @if($cQuestion[0]->state == 1) <button class="btn btn-success btn-user btn-sm" id="giveAnswer">Donner réponse</button> @else <button class="btn btn-info btn-user btn-sm" id="nextQuestion">Question suivante</button> @endif </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h6>Question</h6>
                            <ul>
                                <li>Numéro : {{$cQuestion[0]->id}}</li>
                                <li>Text : {{$cQuestion[0]->text}}</li>
                                <li>Dernière modification : {{$cQuestion[0]->updated_at}}</li>
                                <li>Type :
                                    @if(count($answer)>1)
                                        QCM
                                    @else
                                        @if($cQuestion[0]->image != "")
                                            Image
                                        @else
                                            Simple
                                        @endif
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-4">
                            {{--question--}}
                            <div class="">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="" src="{{url ("storage/".$cQuestion[0]->image)}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <h6>Réponse</h6>
                            <ul>
                                @foreach($answer as $value)
                                    <li>N° {{$loop->iteration}} : {{$value->text}} <span class="font-weight-light">(@if($value->true) vrai @else faux @endif&nbsp;)</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-4">
                            {{--reponse--}}
                            <div class="">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="" src="{{url ("storage/".$answer[0]->image)}}" alt="">
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        @endif
    </div>


@endsection

@section('css')
    <link href="{{URL::asset("css/current.css")}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{URL::asset("js/current.js")}}"></script>
    <script src="{{URL::asset("js/ajax.js")}}"></script>
    <script src="{{URL::asset("js/general.js")}}"></script>
    <script src="{{asset("datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("datatables/dataTables.bootstrap4.min.js")}}"></script>
@endsection
