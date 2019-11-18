@extends("layouts.menu")

@section("content")
    <h5>Lancer une nouvelle partie</h5>
    <div class="container-fluid">
        <form method="post" action="/game/new" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="name">Nom de la partie :</label>
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" value="RoazhonWall {{ date('Y-m-d H:i:s') }}">
                </div>
            </div>
            @error('name')
            <div class="card mb-4 border-left-warning col-sm-6">
                <div class="card-body">
                    {{ $message }}
                </div>
            </div>
        @enderror
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <label for="nolimit">Nombre de joueur max :</label>
                    <input type="number" class="form-control form-control-user @error('gamer') is-invalid @enderror" id="gamer" name="gamer" value="100" step="5">
                </div>
                <div class="col-sm-3 form-inline">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="nolimit" id="nolimit" value="1">
                    </div>
                    <label for="nolimit">Désactiver limite de joueur</label>
                </div>
            </div>
            @error('gamer')
            <div class="card mb-4 border-left-warning col-sm-6">
                <div class="card-body">
                    {{ $message }}
                </div>
            </div>
            @enderror
            <button type="submit" class="aQ btn btn-primary btn-user btn-block col-2 mt-3">
                Commencer
            </button>
    </form>
    </div>

    @if($current)
    <div class="modal fade show" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="gameModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gameModal">Une partie est déjà en cours</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="$('#gameModal').toggle()">×</span>
                    </button>
                </div>
                <div class="modal-body">Commencer une nouvelle partie terminera automatiquement celle en cours.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal" onclick="$('#gameModal').toggle()">Commencer une nouvelle partie</button>
                    <a class="btn btn-info" href="/game/current">Reprendre la partie en cours</a>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('js')
    <script src="{{URL::asset("js/game.js")}}"></script>
@endsection
