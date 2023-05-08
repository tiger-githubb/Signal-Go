@extends('errors.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : '404')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="empty">
            <div class="empty-header">404</div>
            <p style='font-size:25px;'>&#128553;</p>
            <p class="empty-title">Oups… vous venez de trouver une page d'erreur</p>
            <p class="empty-subtitle text-muted">
                Nous sommes désolés mais la page que vous recherchez n'a pas été trouvée
            </p>
            <div class="empty-action">
                <a href="{{route('acceuil')}}" class="btn btn-primary">

                    <svg xmlns="" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M5 12l6 6" />
                        <path d="M5 12l6 -6" />
                    </svg>
                    Retournons a l'acceuil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection