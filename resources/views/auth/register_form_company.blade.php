<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="hidden" name="user_type" value="company">

    <div class="input-block ">
        <label class="focus-label">Nom de l'entreprise
            <span class="label-star"> *</span>
        </label>
        <input type="text" class="form-control floating @error('company_name') is-invalid @enderror" name="company_name"
            value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>

        @error('company_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-block ">
        <label class="focus-label">Nom de famille <span class="label-star">
                *</span></label>
        <input type="text" class="form-control floating @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-block ">
        <label class="focus-label">Prénom(s) <span class="label-star"> *</span></label>
        <input type="text" class="form-control floating @error('first_name') is-invalid @enderror" name="first_name"
            value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

        @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>



    <div class="input-block ">
        <label class="focus-label">Adresse e-mail<span class="label-star"> *</span></label>
        <input type="email" class="form-control floating @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="input-block ">
        <label class="focus-label">Mot de passe <span class="label-star"> *</span></label>
        <div class="position-relative">
            <input type="password" class="form-control floating pass-input @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">
            <div class="password-icon ">
                <span class="fas toggle-password fa-eye-slash"></span>
            </div>
        </div>

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="input-block  mb-0">
        <label class="focus-label">Confirmez le mot de passe <span class="label-star">
                *</span></label>
        <div class="position-relative">
            <input type="password" class="form-control floating pass-inputs" name="password_confirmation" required
                autocomplete="new-password">
            <div class="password-icons">
                <span class="fas toggle-passwords fa-eye-slash"></span>
            </div>
        </div>
    </div>
    <div class="dont-have">
        <label class="custom_check">
            <input type="checkbox" id="rem_password" name="rem_password">
            <span class="checkmark"></span> J'ai lu et accepté <a href="#">Termes &amp; Conditions</a>
        </label>
    </div>

    <button id="signup-btn"
        class="btn btn-primary w-100 btn-lg login-btn d-flex align-items-center justify-content-center" type="submit"
        disabled>
        S'inscrire maintenant
        <i class="feather-arrow-right ms-2"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var checkbox = document.getElementById('rem_password');
        var signupBtn = document.getElementById('signup-btn');

        // Initial state of the button
        signupBtn.classList.add('disabled-btn');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                signupBtn.removeAttribute('disabled');
                signupBtn.classList.remove('disabled-btn');
            } else {
                signupBtn.setAttribute('disabled', 'disabled');
                signupBtn.classList.add('disabled-btn');
            }
        });
    });
    </script>

    <style>
        .btn.disabled-btn {
            background-color: #d3d3d3;
            /* Light grey */
            border-color: #d3d3d3;
            /* Light grey */
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>

    {{-- <div class="login-or">
        <p><span>Ou</span></p>
    </div>
    <div class="row social-login">
        <div class="col-sm-6">
            <a href="javascript:void(0);" class="btn btn-block"><img src="assets/img/icon/google-icon.svg"
                    alt="Google">Google</a>
        </div>
        <div class="col-sm-6">
            <a href="javascript:void(0);" class="btn btn-block"><img src="assets/img/icon/fb-icon.svg"
                    alt="Fb">Facebook</a>
        </div>

    </div> --}}
    <div class="row">
        <div class="col-sm-12 dont-have d-flex  align-items-center">Avez-vous déjà un compte?
            <a href="{{ route('login') }}" class="ms-2">Se connecter</a>
        </div>
    </div>
</form>