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

    <section class="hero" id="hero">
        <div class="heroText">
            <h1 class="text-white mt-5 mb-lg-4" data-aos="zoom-in" data-aos-delay="800">
                Signal'Go
            </h1>

            <p class="text-secondary-white-color" style="font-size: 20px;" data-aos="fade-up" data-aos-delay="1000">
                La plateforme de signalisation des feux Tricolores defectieux au <strong
                    class="custom-underline">Togo</strong>
            </p>
        </div>

        <div class="videoWrapper">
            <video autoplay="" loop="" muted="" class="custom-video"
                poster="">
                <source src="{{ asset('/front/assets/videos/video1.mp4') }}"type="video/mp4">

                La video n'est pas suporter par votre navigateur
            </video>
        </div>

        <div class="overlay"></div>
    </section>

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
                            <li><a href="{{ route('acceuil') }}" class="active">Acceuil</a></li>
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

    <!-- ***** Main Banner Area Start ***** -->
    <section id="section-1">
        <div class="content-slider">
            <div class="slider">
                <div id="top-banner-1" class="banner">
                    <div class="banner-inner-wrapper header-text">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->

    <div id="map"></div>


    <div class="visit-country">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading">
                        <h2>Les signalisations recentes </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="items">

                        <div class="row">
                            @foreach ($reports as $report)
                                <div class="col-lg-12">
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-5">
                                                <div class="image">
                                                    <img src="{{ asset('/front/assets/images/country-01.jpg') }}"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-sm-7">
                                                <div class="right-content">
                                                    <h4>{{ $report->location }} </h4>
                                                    <span> Région {{ $report->region }}</span>

                                                    <p>{{ $report->description }}</p>
                                                    <ul class="info">
                                                        <li>
                                                            @if ($report->comments->count() > 0)
                                                                <span class="comment-count"><i class="fa fa-user"></i>
                                                                    {{ $report->comments->count() }}
                                                                    commentaire{{ $report->comments->count() > 1 ? 's' : '' }}</span>
                                                            @else
                                                                <span class="comment-count"> <i class="fa fa-user"></i>Aucun
                                                                    commentaire</span>
                                                            @endif
                                                        </li>
                                                        <li><i class="fa fa-globe"></i> Longitude :
                                                            {{ $report->longitude }}</li>
                                                        <li><i class="fa fa-globe"></i> Latitude : {{ $report->latitude }}
                                                        </li>
                                                    </ul>

                                                    <div class="d-flex">
                                                        <div class="coments">
                                                            @foreach ($report->comments as $comment)
                                                                <div class="comment-border">
                                                                    <p style="">{{ $comment->comment }}
                                                                        <b class="comment-name"> - par
                                                                            {{ $comment->name }}</b>
                                                                    </p>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="main-button mt-3">
                                                    <a href="{{ route('reportcomment.show', $report->id) }}">Ajouter un
                                                        commentaire</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                            <div class="col-lg-12">
                                <ul class="page-numbers">
                                    <li><a href="#"><i class="fa fa-arrow-left"></i></a></li>
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="fa fa-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="side-bar-map">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126931.66525378477!2d1.1642883422946664!3d6.182315355755898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023e1c113185419%3A0x3224b5422caf411d!2zTG9tw6k!5e0!3m2!1sfr!2stg!4v1683653797511!5m2!1sfr!2stg"
                                        width="100%" height="550px" frameborder="0"
                                        style="border:0; border-radius: 23px; " allowfullscreen scrolling="yes"></iframe>
                                </div>
                            </div>
                        </div>
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
