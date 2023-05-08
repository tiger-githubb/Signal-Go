@extends('auth.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Nouveau mot de passe')

@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">

        </div>
        <form class="card card-md" action="{{ route('password.update') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="card-body">

                <h2 class="card-title text-center mb-4">Nouveau mot de passe</h2>
                <p class="text-center mb-4">Créez un nouveau mot de passe pour accéder a {{ config('app.name') }}</p>

                <div class="mb-3">
                    <label class="form-label">Adresse e-mail</label>
                    <input id="email" name="email" value="{{ $request->email }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Adresse e-mail" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <div class="input-group input-group-flat">
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
                    <div class="input-group input-group-flat">
                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirmer votre mot de passe" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        Reinitialiser
                    </button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            <a href="{{ route('login') }}">renvoyez-moi</a> à l'écran de connexion.
        </div>
    </div>
</div>

@endsection