@extends ('front.layout')

@section('style')
@endsection

@section('header')
@endsection

@section('content')

<div class="">

    <a href="locale/en">{{ __('global.Anglais') }}</a>

    <a href="locale/fr">{{ __('global.Français') }}</a>

    <a>{{ __('front/welcome.pagename') }}</a>

    @if (Route::has('login'))
    @auth
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">Tableau de bord</a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link" href="{{route('login')}}">Connexion</a>
    </li>
    @endauth
    @endif

</div>

@if ($posts->count() > 0)
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h4>Dernières nouvelles</h4>
            <ul class="timeline">
                @foreach ($posts as $post)
                <li>
                    <img class="img-fluid" src="{{ asset('/storage/'.$post->image) }}" alt="">
                    <p>catégorie :
                        <a href="{{ route('category.show', $post->category->slug)}}">{{ $post->category->name }}</a>
                        <span class=" float-right">{{ $post->created_at->format('d M Y') }}</span>
                    </p>
                    <p>publié par : {{ $post->user->name }}</p>
                    <p class="h5">Titre : {{ $post->title }}</p>
                    <p>{!! Str::limit($post->content, 95, '...') !!} </p>
                    <a target="" href="{{ route('article.show', $post->slug) }}">lire plus</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

@endsection


@section('footer')
@endsection

@section('script')
@endsection