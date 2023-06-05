<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="" class="logo">
                        <img src="{{ asset('/front/assets/images/logo.png') }}" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('acceuil') }}"  class="{{ Request::routeIs('acceuil') ? 'active' : '' }}">Acceuil</a></li>
                        <li><a href="{{ route('aPropos') }}" class="{{ Request::routeIs('aPropos') ? 'active' : '' }}">A Propos</a></li>
                        <li><a href="{{ route('signalement.show') }}" class="{{ Request::routeIs('signalement.show') ? 'active' : '' }}">Signaler</a></li>
                        <li><a href="{{ route('signalement.carteshow') }}" class="{{ Request::routeIs('signalement.carteshow') ? 'active' : '' }}">Carte</a></li>


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