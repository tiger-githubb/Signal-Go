@extends('back.layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Modifier un article')

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
                    Modifier un article
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

                <form class="card" action="{{ route('article.update',$post) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h3 class="card-title">Formulaire</h3>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label required">Titre</label>
                            <input id="title" value="{{ $post->title }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Le titre de votre article" autocomplete="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">

                            @if($categories->count() > 0)

                            <label class="form-label required">Catégorie</label>
                            <select class="form-control form-select" id="category" name="category" autocomplete="category" autofocus>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{$post->category_id == $category->id ? 'selected' : ''}}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>

                            @else

                            <p class="card-subtitle">Vous devez publier un article avec une catégorie
                                <a class="" href="{{ route('category.create') }}">Ajoutez une nouvelle catégorie</a> et réessayez.
                            </p>

                            @endif

                        </div>

                        <div class="mb-3">
                            <div class="form-label ">Changer l'image de publication</div>
                            <div class="card-subtitle mt-3 mb-3 info">Choisissez une image carré et d'environ 200 ko pour un affichage optimal.</div>
                            <input type="file" class="form-control" id="image" name="image" accept=".jpg,.jpeg,.png" onchange="validateFileType()">
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Contenu</label>
                            <textarea name="content" id="tinymce-mytextarea" class="form-control @error('content') is-invalid @enderror" placeholder="Le contenu de votre article" autofocus>
                            {{ $post->content }}
                            </textarea>

                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary ms-auto" type="submit">
                            Mettre a jour
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="/back/dist/libs/tinymce/tinymce.min.js?1674944402" defer></script>

<script type="text/javascript">
    function validateFileType() {
        var fileName = document.getElementById("image").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
            //TO DO
        } else {
            alert("Seuls les fichiers JPG / JPEG et PNG sont autorisés!");
        }
    }
</script>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        let options = {
            selector: '#tinymce-mytextarea',
            height: 300,
            menubar: false,
            statusbar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
            options.skin = 'oxide-dark';
            options.content_css = 'dark';
        }
        tinyMCE.init(options);
    })
    // @formatter:on
</script>

@endsection