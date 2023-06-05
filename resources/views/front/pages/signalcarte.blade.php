@extends ('front.layout')

@section('style')

@endsection

@section('header')

@endsection

@section('content')

    <div class="second-page-heading">
        <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <h4>Signal'Go</h4>
            <h2>Carte des signalisations</h2>
            </div>
        </div>
        </div>
    </div>

    <div class="col-lg-12" id="map"></div>

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

            marker.bindPopup("Description: {{ $report->description }}");
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
