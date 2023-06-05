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
                        Gestion des signalisations
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
            <div id="map"></div>
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
                @endif

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style=" padding-bottom: 45px;">
                            <div id="table-default" class="table-responsive">
                                <table class="table">

                                    <thead>
                                        <tr>
                                            @if ($reports->count() > 0)
                                                <th><button class="table-sort" data-sort="sort-updated">mise à jour le
                                                        :</button></th>
                                                <th><button class="table-sort"
                                                        data-sort="sort-category">Localisation</button></th>
                                                <th><button class="table-sort" data-sort="sort-title">Description</button>
                                                </th>
                                                <th></th>
                                            @else
                                                <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">

                                        @if ($reports->count() > 0)

                                            @foreach ($reports as $report)
                                                <tr>
                                                    <td class="sort-updated"
                                                        data-date="{{ $report->updated_at->format('d M Y') }}">
                                                        {{ $report->updated_at->format('d M Y') }}</td>
                                                    <td class="sort-category">{{ $report->location }}</td>
                                                    <td class="sort-title">{{ $report->description }}</td>

                                                    <td>
                                                        <div class="btn-list flex-nowrap">

                                                            <a href="{{ route('signalisation.destroy', $report) }}"
                                                                class="btn btn-outline-danger w-100 btn-icon">

                                                                <svg xmlns=""
                                                                    class=" icon icon-tabler icon-tabler-trash"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                    </path>
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M10 11l0 6"></path>
                                                                    <path d="M14 11l0 6"></path>
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                    </path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                                                    </path>
                                                                </svg>

                                                                <form action="{{ route('signalisation.destroy', $report) }}"
                                                                    method="post">
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
                                                <td class="center"
                                                    style="display: flex;justify-content: space-around;flex-wrap: nowrap;">
                                                    <span style="font-size:24px">
                                                        &#128543; Aucune signalisation disponible !
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialisation de la carte
            var map = L.map('map').setView([51.505, -0.09], 13);

            // Ajouter une couche de tuiles (par exemple OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);


            var customIcon = L.icon({
                iconUrl: '/back/static/photos/feu.png',
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
    <script src="/back/dist/libs/list.js/dist/list.min.js?1674944402" defer></script>
    <script src="/back/dist/libs/tinymce/tinymce.min.js?1674944402" defer></script>



@endsection
