@extends ('front.layout')

@section('style')
@endsection

@section('header')
@endsection

@section('content')

    <div class="second-page-heading" style="padding: 160px 0px 140px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Signal'Go</h4>
                    <h2>{{ $report->location }}</h2>
                    <p>{{ $report->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="reservation-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <form id="reservation-form" name="gs" method="POST"

                        action="{{ route('reportcomment.store', $report->id) }}">
                        @csrf

                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Faire <em>Un Commentaire </em> c'est pousser <em>l'état a reagir</em></h4>
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

@section('cta')
@include('front/inc/cta')
@endsection

@section('script')
@endsection
