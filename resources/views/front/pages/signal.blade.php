
@extends ('front.layout')

@section('style')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9fwpuPcgU81osSKz2MZBkcbHzemfJ5hg"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link href='https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js'></script>


<style>
  @media screen and (min-width: 1024px) {
    #map {
      height: 650px !important;
    }
  }
</style>

@endsection

@section('header')
@endsection

@section('content')


<div class="second-page-heading">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h4>Signal'Go</h4>
        <h2>Faire une signalisation</h2>
        <p>Signaler un feux défectueux c'est aider votre pays</p>
      </div>
    </div>
  </div>
</div>

<div class="more-info reservation-info">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-sm-6">
        <div class="info-item">
          <i class="fa fa-phone"></i>
          <h4>Téléphone</h4>
          <a href="#">+228 90 00 00 00</a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="info-item">
          <i class="fa fa-envelope"></i>
          <h4>Email</h4>
          <a href="#">contacto@signalgo.com</a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="info-item">
          <i class="fa fa-map-marker"></i>
          <h4>Nos bureaux</h4>
          <a href="#">Adjidogomé - Atilamonou</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="reservation-form">
  <div class="container">
    
    <div class="row">
      <div class="col-lg-5">
        <div id="map">
        </div>
      </div>
      <div class="col-lg-7">
        <form id="reservation-form" name="gs" role="search" method="POST" action="{{ route('reports.store') }}">
          @csrf
          <div class="row">
            <div class="col-lg-12">
            </div>
            <div class="col-lg-6">
              <fieldset>
                <label for="Name" class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" placeholder="Ex. Aristide">
              </fieldset>
            </div>
            
            <div class="col-lg-6">
              <fieldset>
                <label for="chooseRegion" class="form-label">Choisir la région</label>
                <select name="region" class="form-select" id="chooseRegion">
                  <option value="Maritime">La région Maritime</option>
                  <option value="Plateaux">La région des Plateaux</option>
                  <option value="Centrale">La région Centrale</option>
                  <option value="Kara">La région de la Kara</option>
                  <option value="Savanes">La région des Savanes</option>
                </select>
              </fieldset>
            </div>
            
            <div class="col-lg-6">
              <fieldset>
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" id="latitude" name="latitude" readonly class="form-control" placeholder="Ex. 6.131845">
              </fieldset>
            </div>

            <div class="col-lg-6">
              <fieldset>
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" id="longitude" name="longitude" readonly class="form-control" placeholder="Ex. 1.222329">
              </fieldset>
            </div>

            <div class="col-lg-12">
              <fieldset>
                <label for="location" class="form-label">Emplacement</label>
                <input placeholder="ex.lome" id="location" type="text" class="form-control @error('location') is-invalid @enderror"
                  name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>
              </fieldset>
            </div>

            <div class="col-lg-12">
              <fieldset>
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                  placeholder="Saisir votre description" required autocomplete="description">{{ old('description') }}</textarea>
              </fieldset>
            </div>
            
            <div class="col-lg-12">
              <fieldset>
                <button type="submit" class="main-button">Poster votre signalisation</button>
              </fieldset>
            </div>
          </div>
        </form>
        
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

      // Récupérer les références des champs d'entrée
      var latitudeInput = document.getElementById('latitude');
      var longitudeInput = document.getElementById('longitude');

      // Créer une icône personnalisée pour les marqueurs
      var customIcon = L.icon({
        iconUrl: '/front/assets/images/feu-selector.png',
          iconSize: [32, 60], // Taille de l'icône en pixels
          iconAnchor: [16, 72] // Point d'ancrage de l'icône par rapport à sa position
      });

      // Ajouter un marqueur initial pour la position actuelle avec l'icône par défaut
      var currentLocationMarker = null;

      // Gestionnaire d'événement pour le clic sur la carte
      function onMapClick(e) {
          var lat = e.latlng.lat.toFixed(6);
          var lng = e.latlng.lng.toFixed(6);

          // Supprimer le marqueur précédent s'il existe
          if (currentLocationMarker) {
              map.removeLayer(currentLocationMarker);
          }

          // Ajouter un marqueur à l'endroit cliqué avec l'icône personnalisée
          var marker = L.marker([lat, lng], { icon: customIcon }).addTo(map)
              .openPopup();

          // Mettre à jour les coordonnées dans les champs d'entrée
          latitudeInput.value = lat;
          longitudeInput.value = lng;

          // Mettre à jour le marqueur de la position actuelle
          currentLocationMarker = marker;
      }

      // Ajouter l'événement de clic à la carte
      map.on('click', onMapClick);

      // Vérifier si la géolocalisation est prise en charge par le navigateur
      if ("geolocation" in navigator) {
          // Obtenir la position actuelle
          navigator.geolocation.getCurrentPosition(function(position) {
              var lat = position.coords.latitude.toFixed(6);
              var lng = position.coords.longitude.toFixed(6);

              // Ajouter un marqueur pour la position actuelle avec l'icône par défaut
              currentLocationMarker = L.marker([lat, lng]).addTo(map)
                  .bindPopup('Votre position actuelle')
                  .openPopup();

              // Centrer la carte sur la position actuelle
              map.setView([lat, lng], 13);

              // Mettre à jour les coordonnées dans les champs d'entrée
              latitudeInput.value = lat;
              longitudeInput.value = lng;
          });
      } else {
          console.log("La géolocalisation n'est pas prise en charge par ce navigateur.");
      }
  });
</script>



<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>




@endsection
