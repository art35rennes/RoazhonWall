@extends('layouts.menu')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$table}}</h6>
        </div>
        <div class="card-body">
            <div class="">
                <table class="table table-bordered" id="dataTable"  cellspacing="0">
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

{{--    <div class="card shadow mb-4">--}}
{{--        <div class="card-header py-3">--}}
{{--            <h6 class="m-0 font-weight-bold text-primary">Ajouter une entrée</h6>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            @switch($table)--}}
{{--            @case('asso')--}}
{{--                <form class="user" method="POST" action="/table/{{$table}}/add">--}}
{{--                    @csrf--}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-sm-10 mb-3 mb-sm-0">--}}
{{--                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" name="email" placeholder="Nom de l'association" value="{{ old('name') }}" required autocomplete="name">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @error('name')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-sm-6 mb-3 mb-sm-0">--}}
{{--                            <input type="text" class="form-control form-control-user @error('rna') is-invalid @enderror" id="rna" name="rna" placeholder="RNA" value="{{ old('rna') }}" autocomplete="rna">--}}
{{--                        </div>--}}


{{--                        <div class="col-sm-6">--}}
{{--                            <input type="text" class="form-control form-control-user @error('responsable') is-invalid @enderror" id="responsable" name="responsable" placeholder="Responsable" value="{{ old('responsable') }}" required autocomplete="responsable">--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    @error('rna')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                    @error('responsable')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-sm-6 mb-3 mb-sm-0">--}}
{{--                            <input type="text" class="form-control form-control-user @error('adresse') is-invalid @enderror" id="adresse" name="adresse" placeholder="Adresse" autocomplete="adresse">--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <input type="email" class="form-control form-control-user @error('mail') is-invalid @enderror" id="mail" name="mail" placeholder="Mail responsable" required autocomplete="mail">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @error('adresse')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                    @error('mail')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-sm-2">--}}
{{--                            <input type="number" class="form-control form-control-user @error('id') is-invalid @enderror" id="id" name="id" placeholder="ID Responsable" autocomplete="id">--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-auto mb-3 mb-sm-0">--}}
{{--                            <label class="btn-user btn-dark @error('attestation') is-invalid @enderror">--}}
{{--                                Ajouter une attestation <input type="file" name="attestation" hidden>--}}
{{--                            </label>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    @error('attestation')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                    @error('id')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

{{--                    <button type="submit" class="btn btn-primary btn-user btn-block col-2">--}}
{{--                        Ajouter--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--                @break--}}
{{--            @case('transaction')--}}
{{--                <form class="user" method="POST" action="/table/{{$table}}/add">--}}
{{--                    @csrf--}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-sm-10 mb-3 mb-sm-0">--}}
{{--                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" name="email" placeholder="Nom de l'association" value="{{ old('name') }}" required autocomplete="name">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @error('name')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-sm-6 mb-3 mb-sm-0">--}}
{{--                            <input type="text" class="form-control form-control-user @error('rna') is-invalid @enderror" id="rna" name="rna" placeholder="RNA" value="{{ old('rna') }}" autocomplete="rna">--}}
{{--                        </div>--}}


{{--                        <div class="col-sm-6">--}}
{{--                            <input type="text" class="form-control form-control-user @error('responsable') is-invalid @enderror" id="responsable" name="responsable" placeholder="Responsable" value="{{ old('responsable') }}" required autocomplete="responsable">--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    @error('rna')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                    @error('responsable')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-sm-6 mb-3 mb-sm-0">--}}
{{--                            <input type="text" class="form-control form-control-user @error('adresse') is-invalid @enderror" id="adresse" name="adresse" placeholder="Adresse" autocomplete="adresse">--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <input type="email" class="form-control form-control-user @error('mail') is-invalid @enderror" id="mail" name="mail" placeholder="Mail responsable" required autocomplete="mail">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @error('adresse')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                    @error('mail')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-sm-2">--}}
{{--                            <input type="number" class="form-control form-control-user @error('id') is-invalid @enderror" id="id" name="id" placeholder="ID Responsable" autocomplete="id">--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-auto mb-3 mb-sm-0">--}}
{{--                            <label class="btn-user btn-dark @error('attestation') is-invalid @enderror">--}}
{{--                                Ajouter une attestation <input type="file" name="attestation" hidden>--}}
{{--                            </label>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    @error('attestation')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                    @error('id')--}}
{{--                    <div class="card mb-4 border-left-warning col-sm-6">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}

{{--                    <button type="submit" class="btn btn-primary btn-user btn-block col-2">--}}
{{--                        Ajouter--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--                @break--}}
{{--            @case('')--}}
{{--                @break--}}
{{--            @default--}}
{{--                <h5>Table non implémenté !</h5>--}}
{{--            @endswitch--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection

@section('js')

    <!-- Page level plugins -->
    <script src="{{asset("datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("datatables/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("datatables/table.js")}}"></script>
@endsection
