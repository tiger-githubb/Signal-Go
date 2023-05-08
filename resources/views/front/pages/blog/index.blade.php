<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        ul.timeline {
            list-style-type: none;
            position: relative;
        }

        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 20px 0;
            padding-left: 20px;
        }

        ul.timeline>li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4>Dernières nouvelles</h4>
                <ul class="timeline">
                    @foreach ($posts as $post)
                    <li>
                        <p>catégorie :
                            <a href="{{ route('category.show', $post->category->slug)}}">{{ $post->category->name }}</a>
                            <span class=" float-right">{{ $post->created_at->format('d M Y') }}</span>
                        </p>
                        <p>publié par : {{ $post->user->name }}</p>
                        <p class="h5">Titre : {{ $post->title }}</p>
                        <p>{{ Str::limit($post->content, 95, '...') }}</p>
                        <a target="" href="{{ route('article.show', $post->slug) }}">lire plus</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>

</html>