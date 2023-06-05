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
          <h2>A Propos</h2>
          <p>La plateforme de signalisation des feux Tricolores defectieux au Togo</p>
        </div>
      </div>
    </div>
  </div>
  
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
            <h3>A Propos de nous </h3>
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
        </div>
      </div>
    </div>
  </div>

@endsection

@section('cta')
@include('front/inc/cta')
@endsection

@section('script')
@endsection
