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
                            <li><a href="{{ route('acceuil') }}" >Acceuil</a></li>
                            <li><a href="{{ route('aPropos') }}" class="active">A Propos</a></li>
                            <li><a href="{{ route('signalement.show') }}" >Signaler</a></li>
  
  
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
  <div class="about-main-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="content">
            <div class="blur-bg"></div>
            <h2>Signal'Go</h2>
            <p>La plateforme de signalisation des feux Tricolores defectieux au Togo

            </p>
            <div class="main-button">
              <a href="{{ route('signalement.show') }}">Faire une signalisation</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Main Banner Area End ***** -->

  <div class="more-about">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="left-image">
            <img src="{{ asset('/front/assets/images/about-left-image.jpg') }}" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="section-heading">
            <h2>A Propos de nous </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="info-item">
                <h4> 120</h4>
                <span>Signalisations</span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-item">
                <h4>75</h4>
                <span>Reparations</span>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="info-item">
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <h4>450</h4>
                    <span>Feux Tricolores</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
          <div class="main-button">
            <a href="{{ route('signalement.show') }}">Faire une siGnalisation</a>
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
