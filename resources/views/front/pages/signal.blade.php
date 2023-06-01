
@extends ('front.layout')

@section('style')
@endsection

@section('header')
@endsection

@section('content')

@endsection

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
                          <li><a href="{{ route('acceuil') }}" >Acceuil</a></li>
                          <li><a href="{{ route('aPropos') }}">A Propos</a></li>
                          <li><a href="{{ route('signalement.show') }}"  class="active" >Signaler</a></li>


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

  <div class="second-page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h4>Signal'Go</h4>
          <h2>Faire une signalisation</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt uttersi labore et
            dolore magna aliqua is ipsum suspendisse ultrices gravida</p>
          <div class="main-button"><a href="about.html">Voir les signalisations</a></div>
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
        <div class="col-lg-12">
          <div id="map">
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126931.66525378477!2d1.1642883422946664!3d6.182315355755898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023e1c113185419%3A0x3224b5422caf411d!2zTG9tw6k!5e0!3m2!1sfr!2stg!4v1683653797511!5m2!1sfr!2stg"

              width="100%" height="450px" frameborder="0"
              style="border:0; border-top-left-radius: 23px; border-top-right-radius: 23px;"
              allowfullscreen=""></iframe>
          </div>
        </div>
        <div class="col-lg-12">
          <form id="reservation-form" name="gs" role="search"  method="POST" action="{{ route('reports.store') }}" >
            @csrf
            <div class="row">
              <div class="col-lg-12">
                <h4>Faire <em>Une signalisation</em> c'est aider <em>Son pays</em></h4>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="Name" class="form-label">Nom</label>
                  <input type="text" name="Name" class="Name" placeholder="Ex. Aristide">
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="emplacement" class="form-label">Emplacement</label>
                  <input  placeholder="ex.lome" id="location" type="text"
                  class="Number @error('location') is-invalid @enderror" name="location"
                  value="{{ old('location') }}" required autocomplete="location" autofocus >
                    
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="chooseGuests" class="form-label">Choisir la region </label>
                  <select name="Guests" class="form-select" aria-label="Default select example" id="chooseGuests"
                    onChange="this.form.click()">
                    <option type="checkbox" name="option1" value="Maritime">La région Maritime</option>
                    <option value="Plateaux">La région des Plateaux</option>
                    <option value="Centrale">La région Centrale</option>
                    <option value="Kara">La région de la Kara</option>
                    <option value="Savanes">La région des Savanes</option>

                  </select>
                </fieldset> 
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="Number" class="form-label">le rue </label>
                  <input type="date" name="date" class="date" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <textarea id="description" name="description" rows="4" cols="40" class="form-control @error('description') is-invalid @enderror"placeholder="    saisir votre description " required autocomplete="description">{{ old('description') }}</textarea>
                  
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button  type="submit" class="main-button">poster votre signalisation</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



@section('footer')
@endsection

@section('script')
@endsection
