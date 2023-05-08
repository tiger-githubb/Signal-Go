@extends('auth.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Mot de passe oublié')

@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">

        </div>
        <form class="card card-md" action="{{ route('password.request') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">

                <h2 class="card-title text-center mb-4">Récupération de compte</h2>
                <p class="text-center mb-4">Afin de protéger votre compte, {{ config('app.name') }} veut s'assurer que c'est bien vous qui essayez de vous connecter</p>

                @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Adresse e-mail</label>
                    <input id="" name="email" type=" email" class="form-control @error('email') is-invalid @enderror" placeholder="Saisissez votre adresse e-mail" required>

                    @error('email')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        Envoyez moi un e-mail
                    </button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            Oubliez cela, renvoyez-moi à <a href="{{ route('login') }}">l'écran de connexion.</a>
        </div>
    </div>
</div>

@endsection