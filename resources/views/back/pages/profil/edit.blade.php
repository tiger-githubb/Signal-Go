@extends('back.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Paramètres')

@section('header')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Paramètres du compte
                </h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                    <div class="card-body">
                        <h4 class="subheader">Paramètres utilisateur</h4>
                        <div class="list-group list-group-transparent">
                            <a href="{{ route('editProfil') }}" class="list-group-item list-group-item-action d-flex align-items-center active">Mon compte</a>
                        </div>
                    </div>
                </div>

                <form class="col d-flex flex-column" action="{{ route('user-profile-information.update') }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <h2 class="mb-4">Mon compte</h2>

                        @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <h3 class="card-title">Image de profil</h3>
                        <div class="row align-items-center">
                            <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url({{ asset('back/dist/img/tiger.jpg') }})"></span>
                            </div>
                        </div>
                        <h3 class="card-title mt-4">Détails du compte</h3>
                        <p class="card-subtitle">Vous ne pouvez pas modifier votre email.</p>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-label">Role</div>
                                <input type="text" class="form-control" placeholder="Administrateur" disabled>
                            </div>

                            <div class="col-md">
                                <div class="form-label">Email</div>
                                <input id="email" name="email" value="{{ old('email') ?? Auth::user()->email }}" type="email" placeholder="Adresse e-mail" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" readonly>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md">
                                <div class="form-label">Nom</div>
                                <input id="name" name="name" value="{{ old('email') ?? Auth::user()->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <h3 class="card-title mt-4">Mot de passe</h3>
                        <p class="card-subtitle">Vous pouvez modifier votre mot de passe si vous le souhaitez.</p>
                        <div>
                            <a href="{{ route('passwordMaj') }}" class="btn">
                                Definir un nouveau mot de passe
                            </a>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection