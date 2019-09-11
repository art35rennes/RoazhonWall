@extends("layouts.menu")

@section("content")
<h5>Ajouter une question au Roazhon Wall</h5>
    <div class="container-fluid">
        <form method="post" action="/question/add" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="question">Question :</label>
                    <textarea type="text" class="form-control form-control-user @error('question') is-invalid @enderror" id="question" name="question" placeholder="..." value="{{ old('name') }}" required></textarea>
                </div>
            </div>
            @error('question')
            <div class="card mb-4 border-left-warning col-sm-6">
                <div class="card-body">
                    {{ $message }}
                </div>
            </div>
            @enderror

            <div>
                <label class="d-block">Type de réponse :</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input tQ" type="radio" name="typeQuestion" id="ouverte" value="q" required>
                    <label class="form-check-label" for="ouverte">Question ouverte</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input tQ" type="radio" name="typeQuestion" id="multiple" value="m" required>
                    <label class="form-check-label" for="multiple">Choix multiple</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input tQ" type="radio" name="typeQuestion" id="image" value="i" required>
                    <label class="form-check-label" for="image">Image</label>
                </div>
            </div>


            <div id="reponse_ouverte" class="d-none form-group row mt-3">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Réponse :</label>
                    <input type="text" class="form-control form-control-user @error('ouverte') is-invalid @enderror" id="ouverte" name="ouverte" placeholder="..." value="{{ old('ouverte') }}">
                </div>
            </div>

            <div id="reponse_multiple" class="d-none mt-3">
                <label>Réponse <small>(cocher la bonne réponse)</small>:</label>
                <div class="row">
                    <div class="col-sm-auto form-group form-inline">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponseRadio" id="reponseRadio1" value="1">
                        </div>
                        <input type="text" class="rmQ form-control form-control-user @error('reponse1') is-invalid @enderror" id="reponse1" name="reponse1" placeholder="réponse 1" value="{{ old('reponse1') }}">
                    </div>
                    <div class="col-sm-auto form-group form-inline">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponseRadio" id="reponseRadio2" value="2">
                        </div>
                        <input type="text" class="rmQ form-control form-control-user @error('reponse2') is-invalid @enderror" id="reponse2" name="reponse2" placeholder="réponse 2" value="{{ old('reponse2') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-auto form-group form-inline">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponseRadio" id="reponseRadio3" value="3">
                        </div>
                        <input type="text" class="rmQ form-control form-control-user @error('reponse3') is-invalid @enderror" id="reponse3" name="reponse3" placeholder="réponse 3" value="{{ old('reponse3') }}">
                    </div>
                    <div class="col-sm-auto form-group form-inline">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponseRadio" id="reponseRadio4" value="4">
                        </div>
                        <input type="text" class="rmQ form-control form-control-user @error('reponse4') is-invalid @enderror" id="reponse4" name="reponse4" placeholder="réponse 4" value="{{ old('reponse4') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-auto form-group form-inline">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponseRadio" id="reponseRadio5" value="5">
                        </div>
                        <input type="text" class="rmQ form-control form-control-user @error('reponse5') is-invalid @enderror" id="reponse5" name="reponse5" placeholder="réponse 5" value="{{ old('reponse5') }}">
                    </div>
                    <div class="col-sm-auto form-group form-inline">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reponseRadio" id="reponseRadio6" value="6">
                        </div>
                        <input type="text" class="rmQ form-control form-control-user @error('reponse6') is-invalid @enderror" id="reponse6" name="reponse6" placeholder="réponse 6" value="{{ old('reponse6') }}">
                    </div>
                </div>
                @error('reponseRadio')
                <div class="card mb-4 border-left-warning col-sm-6">
                    <div class="card-body">
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </div>

            <div id="reponse_image" class="d-none mt-3">
                <label class="d-block">Réponse et complément :</label>
                    <div class="custom-file col-6 mb-3">
                        <input type="file" class="custom-file-input" id="imageQ" name="imageQ">
                        <label class="custom-file-label" for="imageQ">Image flouté</label>
                    </div>
                    <div class="custom-file col-6 mb-3">
                        <input type="file" class="custom-file-input" id="imageA" name="imageA">
                        <label class="custom-file-label" for="imageA">Image nette</label>
                    </div>
            </div>

            <button type="submit" class="aQ btn btn-primary btn-user btn-block col-2 mt-3" disabled>
                Ajouter
            </button>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset("js/question.js")}}"></script>
@endsection
