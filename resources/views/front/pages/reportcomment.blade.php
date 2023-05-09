@extends ('front.layout')

@section('style')
@endsection

@section('header')
@endsection

@section('content')


    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="{{ asset('/front/assets/images/logo.png') }}" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{ route('acceuil') }}" class="">Acceuil</a></li>
                            <li><a href="{{ route('aPropos') }}">A Propos</a></li>
                            <li><a href="{{ route('signalement.show') }}">Signaler</a></li>


                            @if (Route::has('login'))
                                @auth
                                    <li class="nav-item">
                                        <a class="" href="{{ route('dashboard') }}">Tableau de bord</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="" href="{{ route('login') }}">Connexion</a>
                                    </li>
                                @endauth
                            @endif

                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="second-page-heading" style="padding: 160px 0px 140px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Signal'Go</h4>
                    <h2>{{ $report->location }}</h2>
                    <p>{{ $report->description }}</p>
                    <div class="main-button"><a href="about.html">Voir les autres signalisations</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="reservation-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form id="reservation-form" name="gs" method="POST"

                        action="{{ route('reportcomment.store', $report->id) }}">
                        @csrf

                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Faire <em>Un Commantaire </em> c'est pousser <em>l'état a reagir</em></h4>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="Name" class="form-label">Nom</label>
                                    <input id="name" type="text"
                                        class="name @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autofocus>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">

                                    <textarea placeholder="    saisir votre description " id="comment" rows="4" cols="40"  class="col-12 name @error('comment') is-invalid @enderror" name="comment" required>{{ old('comment') }}</textarea>


                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button class="main-button" type="submit">Faire votre commantaire</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('footer')
@endsection

@section('script')
@endsection
