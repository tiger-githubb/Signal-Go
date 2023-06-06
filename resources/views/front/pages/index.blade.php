@extends ('front.layout')

@section('style')

@endsection

@section('header')
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
                poster="{{asset('front/assets/images/about-content-bg.jpg')}}">
                <source src="front/assets/images/video1.mp4"type="video/mp4">

                La video n'est pas suportté par votre navigateur
            </video>
        </div>

        <div class="overlay"></div>
    </section>
@endsection

@section('content')



    <div class="visit-country">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading">
                        <h2>Les signalisations récentes </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="items">

                        <div class="row">
                            @foreach ($reports as $report)
                                <div class="col-lg-8">
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
                                                    <ul class="info d-flex">
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
                                                        <li><i class="fa fa-globe"></i>La longitude :
                                                            {{ $report->longitude }}</li>
                                                        <li><i class="fa fa-globe"></i>La latitude : {{ $report->latitude }}
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
                                <div class="col-lg-4">
                                    <div class="side-bar-map">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="map"></div>
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
            </div>
        </div>
    </div>
@endsection



@section('cta')
@include('front/inc/cta')
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialisation de la carte
        var map = L.map('map').setView([51.505, -0.09], 13);

        // Ajouter une couche de tuiles (par exemple OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);


        var customIcon = L.icon({
            iconUrl: '/front/assets/images/feu.png',
            iconSize: [30, 47], // Taille de l'icône en pixels
            iconAnchor: [16, 32], // Point d'ancrage de l'icône
        });

        // Boucle sur les données de signalisation
        @foreach ($reports as $report)
            var latitude = {{ $report->latitude }};
            var longitude = {{ $report->longitude }};

           
            // Créer un marqueur avec une icône personnalisée
            var marker = L.marker([latitude, longitude], {
                icon: customIcon
            }).addTo(map);

            marker.bindPopup("Localisation: {{ $report->location }}");
        @endforeach
        // Vérifier si la géolocalisation est prise en charge par le navigateur
        if ("geolocation" in navigator) {
            // Obtenir la position actuelle
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                // Ajouter un marqueur pour la position actuelle
                L.marker([lat, lng]).addTo(map)
                    .bindPopup('Votre position actuelle')
                    .openPopup();

                // Centrer la carte sur la position actuelle
                map.setView([lat, lng], 13);
            });
        } else {
            console.log("La géolocalisation n'est pas prise en charge par ce navigateur.");
        }
    });
</script>
@endsection
