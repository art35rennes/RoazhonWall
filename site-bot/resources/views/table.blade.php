@extends('layouts.menu')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$table}}</h6>
        </div>
        <div class="card-body">
            <div class="">
                <table class="table table-bordered dataTableFull"  cellspacing="0">
                    <thead>
                    <tr>
                        @foreach($headers as $header)
                            <th>{{$header}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $row)
                    <tr>
                        @foreach($row as $data)
                        <td class="text-truncate" style="max-width: 22ch">{{$data}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <!-- Page level plugins -->
    <script src="{{asset("datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("datatables/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("datatables/table.js")}}"></script>
@endsection
