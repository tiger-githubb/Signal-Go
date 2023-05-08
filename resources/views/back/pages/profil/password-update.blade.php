@extends('auth.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Nouveau mot de passe')

@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="{{ route('user-password.update') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            @method('PUT')

            <div class="card-body">

                <h2 class="card-title text-center mb-4">Nouveau mot de passe</h2>

                @if(session('status') == "password-updated")
                <div class="alert alert-success" role="alert">
                    Mot de passe mis à jour avec succès.
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Mot de passe actuel</label>
                    <div class="input-group input-group-flat">
                        <input id="current_password" name="current_password" type="password" class="form-control @error('current_password','updatePassword') is-invalid @enderror" placeholder="Saisissez votre mot de passe actuel" required autofocus>

                        @error('current_password','updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nouveau mot de passe</label>
                    <div class="input-group input-group-flat">
                        <input id="password" name="password" type="password" class="form-control @error('password','updatePassword') is-invalid @enderror" placeholder="Saisissez votre nouveau mot de passe" required autocomplete="new-password">

                        @error('password','updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmation</label>
                    <div class="input-group input-group-flat">
                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirmer votre nouveau mot de passe" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        Soumettre
                    </button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            <a href="{{ route('editProfil') }}">retour</a>
        </div>
    </div>
</div>

@endsection