@extends("layouts.menu")

@section("content")
    <h5>{{$current->nom}}</h5>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <table class="table table-bordered dataTableFull"  cellspacing="0">
                    <thead>
                    <tr>
                        <th>Joueur</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <td>{{$player->pseudo}}</td>
                            <td class="text-center">
                                @if($player->type == "joueur")
                                    <i class="fas fa-crown"></i>
                                @else
                                    <i class="fas fa-level-down-alt"></i>
                                @endif
                                <i class="ml-1 fas fa-ban"></i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-6">
                <table class="table table-bordered dataTableFull">
                    <thead>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Récurrence</th>
                        <th>Action-</th>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                        <tr>
                            <td>{{$question['resume']->texte}}</td>
                            <td>
                                @switch($question->liste[0]->responses)
                                    @case ("1")
                                    @if($question->liste[0]->image)
                                        Image
                                    @else
                                        Question ouverte
                                    @endif
                                    @break

                                    @default
                                    QCM
                                    @break
                                @endswitch
                            </td>
                            <td>{{$question->recurrence}}</td>
                            <td>
                                @if($question->state)
                                    <i class="fas fa-times-circle"></i>
                                @else
                                    <i class="fas fa-play-circle"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('css')
    <link href="{{URL::asset("css/current.css")}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{URL::asset("js/current.js")}}"></script>
    <script src="{{URL::asset("js/general.js")}}"></script>
    <script src="{{asset("datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("datatables/dataTables.bootstrap4.min.js")}}"></script>
@endsection
