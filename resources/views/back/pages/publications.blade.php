@extends('back.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Articles')

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
                    Gestion des articles
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('category.create')}}" class="btn">
                            Nouvelle catégorie
                        </a>
                    </span>
                    <a href="{{ route('article.create')}}" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Nouvel article
                    </a>
                </div>
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

            @if (session('status'))
            <div class="alert alert-success" style="display: flex;justify-content: center;">
                {{ session('status') }}
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger" style="display: flex;justify-content: center;">
                {{ session('error') }}
            </div>
            @else
            <div class="alert alert-dark" style="display: flex;justify-content: center;">
                <p>
                    Pour rechercher une catégorie ou une publication <a class="" href="{{route ('blog')}}"> allez ici.</a>
                </p>
            </div>
            @endif


            <div class="col-lg-4">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>

                                    @if($categories->count() > 0)
                                    <th>Catégories récents </th>
                                    <th class="w-1"></th>
                                    @else
                                    <th></th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>

                                @if($categories->count() > 0)

                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>

                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('category.show', $category->slug) }}" class="btn btn-outline-info w-100 btn-icon">
                                                <svg xmlns="" class="icon icon-tabler icon-tabler-eye-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                    <path d="M11.143 17.961c-3.221 -.295 -5.936 -2.281 -8.143 -5.961c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6c-.222 .37 -.449 .722 -.68 1.057"></path>
                                                    <path d="M15 19l2 2l4 -4"></path>
                                                </svg>
                                            </a>

                                            <a href="{{ route('category.edit', $category->slug) }}" class="btn btn-outline-warning w-100 btn-icon">
                                                <svg xmlns="" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg>
                                            </a>

                                            <a href="{{ route('category.destroy', $category->id) }}" class="btn btn-outline-danger w-100 btn-icon">

                                                <svg xmlns="" class=" icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7l16 0"></path>
                                                    <path d="M10 11l0 6"></path>
                                                    <path d="M14 11l0 6"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                </svg>

                                                <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @else
                                <tr>
                                    <td class="center" style="display: flex;justify-content: space-around;flex-wrap: nowrap;">
                                        <span style="font-size:14px">
                                            &#128400; Ajoutez une catégorie !
                                        </span>
                                    </td>
                                </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body" style=" padding-bottom: 45px;">
                        <div id="table-default" class="table-responsive">
                            <table class="table">

                                <thead>
                                    <tr>
                                        @if($posts->count() > 0)
                                        <th><button class="table-sort" data-sort="sort-updated">mise à jour le :</button></th>
                                        <th><button class="table-sort" data-sort="sort-category">Catégorie</button></th>
                                        <th><button class="table-sort" data-sort="sort-title">Articles récents</button></th>
                                        <th></th>
                                        @else
                                        <th></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">

                                    @if($posts->count() > 0)

                                    @foreach ($posts as $post)
                                    <tr>
                                        <td class="sort-updated" data-date="{{ $post->updated_at->format('d M Y') }}">{{ $post->updated_at->format('d M Y') }}</td>
                                        <td class="sort-category">{{ $post->category->name}}</td>
                                        <td class="sort-title">{{ $post->title }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">

                                                <a href="{{ route('article.show', $post->slug) }}" class="btn btn-outline-info w-100 btn-icon">
                                                    <svg xmlns="" class="icon icon-tabler icon-tabler-eye-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                        <path d="M11.192 17.966c-3.242 -.28 -5.972 -2.269 -8.192 -5.966c2.4 -4 5.4 -6 9 -6c3.326 0 6.14 1.707 8.442 5.122"></path>
                                                        <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>
                                                    </svg>
                                                </a>

                                                <a href="{{ route('article.edit', $post->slug) }}" class="btn btn-outline-warning w-100 btn-icon">
                                                    <svg xmlns="" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg>
                                                </a>

                                                <a href="{{ route('article.destroy', $post) }}" class="btn btn-outline-danger w-100 btn-icon">

                                                    <svg xmlns="" class=" icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>

                                                    <form action="{{ route('article.destroy', $post) }}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                    </form>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @else
                                    <tr>
                                        <td class="center" style="display: flex;justify-content: space-around;flex-wrap: nowrap;">
                                            <span style="font-size:24px">
                                                &#128543; Aucun article disponible !
                                            </span>
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('modals')
@endsection

@section('scripts')

<script src="/back/dist/libs/list.js/dist/list.min.js?1674944402" defer></script>
<script src="/back/dist/libs/tinymce/tinymce.min.js?1674944402" defer></script>



@endsection