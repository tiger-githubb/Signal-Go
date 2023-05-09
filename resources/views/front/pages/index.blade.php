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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Nouveau signalement') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('reports.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Emplacement') }}</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>

                                    @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description') }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enregistrer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 100px !important">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Liste des signalements') }}</div>

                    <div class="card-body">
                        <ul>
                            @foreach ($reports as $report)
                                <li>
                                    {{ $report->location }} - {{ $report->description }}

                                    @if ($report->comments->count() > 0)
                                    <span class="comment-count">{{ $report->comments->count() }} commentaire{{ ($report->comments->count() > 1) ? 's' : '' }}</span>
                                    @else
                                        <span class="comment-count">Aucun commentaire</span>
                                    @endif
                                    
                                </li>
                                <a href="{{ route('reportcomment.show', $report->id) }}">Ajouter un commentaire</a>
                        
                                <ul>
                                    @foreach ($report->comments as $comment)
                                        <li>{{ $comment->comment }} - par {{ $comment->name }}</li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('footer')
@endsection

@section('script')
@endsection