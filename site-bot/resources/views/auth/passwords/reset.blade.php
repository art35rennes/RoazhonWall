@extends('layouts.custom')

@section('body')
    <body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Réinitialisation de votre mot de passe</h1>
                                        <p class="mb-4">Saisissez votre email et votre nouveau mot de passe !</p>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" placeholder="Entrer votre adresse mail..." value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                        @error('email')
                                        <div class="card mb-4 border-left-warning">
                                            <div class="card-body">
                                                {{ $message }}
                                            </div>
                                        </div>
                                        @enderror

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" aria-describedby="emailHelp" placeholder="Nouveau mot de passe" required autocomplete="new-password">
                                        </div>
                                        @error('password')
                                        <div class="card mb-4 border-left-warning">
                                            <div class="card-body">
                                                {{ $message }}
                                            </div>
                                        </div>
                                        @enderror

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password-confirm" name="password-confirm" aria-describedby="emailHelp" placeholder="Confirmer nouveau mot de passe" required autocomplete="new-password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Réinitialiser votre mot de passe
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">S'inscrire !</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">Déjà inscrit? Connectez-vous!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    </body>
@endsection
