@extends('back.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Créer une categorie')

@section('header')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Aperçu
                </div>
                <h2 class="page-title">
                    Créer une categorie
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
        <div class="row row-cards">

            <div class="col-lg-8">

                <form class="card" action="{{ route('category.store') }}" method="POST">

                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Formulaire</h3>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label required">Nom de la categorie</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Le nom de votre catégorie" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary ms-auto" type="submit">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection

@section('scripts')


@endsection