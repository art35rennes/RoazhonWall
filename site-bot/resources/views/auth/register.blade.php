@extends('layouts.custom')

@section('body')

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">S'inscrire ! </h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nom Prénom" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
{{--                                <div class="col-sm-6">--}}
{{--                                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Prénom">--}}
{{--                                </div>--}}

                            </div>
                            @error('name')
                            <div class="card mb-4 border-left-warning col-sm-6">
                                <div class="card-body">
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Adresse Email" value="{{ old('email') }}" required autocomplete="email">

                            </div>
                            @error('email')
                            <div class="card mb-4 border-left-warning col-sm-6">
                                <div class="card-body">
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="Répéter le mot de passe" required autocomplete="new-password">
                                </div>
                            </div>
                            @error('password')
                            <div class="card mb-4 border-left-warning col-sm-6">
                                <div class="card-body">
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Valider l'inscription
                            </button>
{{--                            <hr>--}}
{{--                            <a href="index.html" class="btn btn-google btn-user btn-block disabled">--}}
{{--                                <i class="fab fa-google fa-fw"></i> S'inscrire avec Google--}}
{{--                            </a>--}}
{{--                            <a href="index.html" class="btn btn-facebook btn-user btn-block disabled">--}}
{{--                                <i class="fab fa-facebook-f fa-fw"></i> S'inscrire avec Facebook--}}
{{--                            </a>--}}
                        </form>
                        <hr>

                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Déjà inscrit? Connectez-vous!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>

@endsection
