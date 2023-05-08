@extends('auth.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Inscription')

@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">

        </div>
        <form class="card card-md" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="card-body">

                <h2 class="card-title text-center mb-2">Créer votre compte</h2>
                <h3 class="h3 text-center mb-4">Accéder à {{ config('app.name') }}</h3>

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input id="name" name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Adresse e-mail</label>
                    <input id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Adresse e-mail" class="form-control @error('email') is-invalid @enderror" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <div class="nput-group input-group-flat">
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Saisissez votre mot de passe" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmation</label>
                    <div class="nput-group input-group-flat">
                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirmer votre mot de passe" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Créer un nouveau compte</button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            Vous avez déja un compte ? <a href="{{ route('login') }}" tabindex="-1">Se connecter</a>
        </div>
    </div>
</div>

@endsection