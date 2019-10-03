@extends("layouts.menu")

@section("content")
    @if($id == null)
    <h5>Liste des questions du Roazhon Wall</h5>

    <div class="card-body">
        <div class="">
            <table class="table table-bordered dataTable"  cellspacing="0">
                <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{$header}}</th>
                    @endforeach
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->text}}</td>
                        <td>
                            @switch($row->reponses)
                                @case ("1")
                                    @if($row->image)
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
                        <td>{{$row->updated_at}}</td>
                        <td class="text-center"><i class="fa fa-eye"></i></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <h5>Question</h5>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Détail</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h6>Question</h6>
                        <ul>
                            <li>Numéro : {{$datas['question'][0]->id}}</li>
                            <li>Text : {{$datas['question'][0]->text}}</li>
                            <li>Dernière modification : {{$datas['question'][0]->updated_at}}</li>
                            <li>Type : {{$type}}</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        {{--question--}}
                        <div class="">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="" src="{{url ("storage/".$datas['question'][0]->image)}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6>Réponse</h6>
                        <ul>
                        @foreach($datas['answer'] as $answer)
                            <li>Réponse {{$answer->id}} : {{$answer->text}} <span class="font-weight-light">(@if($answer->true) vrai @else faux @endif\)</span></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="col-6">
                        {{--reponse--}}
                        <div class="">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="" src="{{url ("storage/".$datas['answer'][0]->image)}}" alt="">
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endif

@endsection

@section('js')
    <script src="{{URL::asset("js/question.js")}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset("datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("datatables/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("datatables/table.js")}}"></script>
@endsection
