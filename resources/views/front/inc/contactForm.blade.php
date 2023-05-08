<div class="p-lg-5 ps-lg-0">
    <div class="section-title text-start">
        <h1 class="display-5 mb-4">Contactez-nous</h1>
    </div>
    <p class="mb-4" style="text-align: justify;">
        Nous sommes ravis de vous offrir un service client de qualité et nous sommes à votre disposition pour toute question ou préoccupation. Veuillez remplir le formulaire ci-dessous avec vos informations de contact et votre message.
    </p>

    <!-- Success message -->
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif
    <!-- Error message -->
    @if(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
    @endif

    <form action="" method="post" action="{{ route('contact.send') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name" placeholder="Votre nom" required>
                    <label for="name">Votre Nom </label>
                    @if ($errors->has('name'))
                    <div class="error">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email" id="email" placeholder="Votre Email" required>
                    <label for="email">Votre Email</label>
                    @if ($errors->has('email'))
                    <div class="error">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" name="phone" id="phone" placeholder="Votre numéro de téléphone" required>
                    <label for="phone">Télephone</label>
                    @if ($errors->has('phone'))
                    <div class="error">
                        {{ $errors->first('phone') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" name="subject" id="subject" placeholder="objet" required>
                    <label for="subject">Objet</label>
                    @if ($errors->has('subject'))
                    <div class="error">
                        {{ $errors->first('subject') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Saisir votre message ... " class="form-control {{ $errors->has('message') ? 'error' : '' }}" name="message" id="message" rows="4" style="height: 150px" required></textarea>
                    <label for="message">Saisir votre message</label>
                    @if ($errors->has('message'))
                    <div class="error">
                        {{ $errors->first('message') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary-gradient bg-primary w-100 py-3" name="send" value="Submit" type="submit">Envoyer votre message</button>
            </div>
        </div>
    </form>
</div>