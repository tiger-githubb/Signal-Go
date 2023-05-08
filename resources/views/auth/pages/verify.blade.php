@extends('auth.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Verification e-mail')

@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">

        </div>
        <div class="card card-md">
            <div class="card-body">

                <h2 class="h2 text-center mb-2">Verification e-mail</h2>
                <h3 class="h3 text-center mb-4">Pour accéder à {{ config('app.name') }} vous devez verifier votre e-mail, consulter votre boite de réception pour le lien de vérification</h3>

                @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Renvoyer l'e-mail</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection