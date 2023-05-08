@extends('auth.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Connexion')

@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">

        </div>
        <div class="card card-md">
            <div class="card-body">

                <h2 class="h2 text-center mb-2">Connexion</h2>
                <h3 class="h3 text-center mb-4">Accéder à {{ config('app.name') }}</h3>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Adresse e-mail</label>
                        <input id="email" name="email" value="{{ old('email') }}" type=" email" class="form-control @error('email') is-invalid @enderror" placeholder=" Adresse e-mail" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label">
                            Mot de passe
                            <span class="form-label-description">
                                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            </span>
                        </label>
                        <div class="input-group input-group-flat">
                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Saisissez votre mot de passe" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Suivant</button>
                    </div>
                </form>
            </div>
            <div class="hr-text"></div>
        </div>
        <div class="text-center text-muted mt-3">
            Vous n'avez pas encore de compte ? <a href="{{ route('register') }}" tabindex="-1">Inscrivez vous</a>
        </div>
    </div>
</div>

@endsection