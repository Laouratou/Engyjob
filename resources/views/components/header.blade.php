<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENGYJOB</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <header class="header header-two">
        <div class="top-header">
            <div class="container">
                <div class="top-head-items">
                    <ul class="nav user-menu">
                        <li class="nav-item dropdown has-arrow flag-nav">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);"
                                role="button">
                                <img src="/assets/img/flags/fr.png" class="me-1" alt="Flag" height="20">
                                <span>Français</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="/assets/img/flags/fr.png" alt="Flag" height="16"> Français
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="/assets/img/flags/us.png" alt="Flag" height="16"> English
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="top-header-links">
                        <li>
                            <ul>
                                <li><a href="javascript:void(0);"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa-regular fa-bell"></i></a></li>
                            </ul>
                        </li>
                        @auth
                        <li>
                            @if (auth()->user()->user_type == 'freelancer')
                            <a href="{{ route('freelancers.dashboard') }}">
                                <i class="feather feather-lock"></i>
                                Dashboard
                            </a>
                            @elseif(auth()->user()->user_type == 'company')
                            <a href="{{ route('company.dashboard') }}">
                                <i class="feather feather-lock"></i>
                                Dashboard
                            </a>
                            @endif
                        </li>
                        @if (auth()->user()->user_type == 'admin')
                        <li>
                            <a href="{{ route('dashboard') }}" target="_blank">
                                <i class="feather feather-user"></i>
                                Admin
                            </a>
                        </li>
                        @endif
                        @else
                        <li>
                            <a href="{{ route('register') }}"><i class="feather feather-lock"></i>S'inscrire</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}"><i class="feather feather-user"></i>Connexion</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <nav class="navbar navbar-expand-lg header-nav p-0">
                <div class="navbar-header header-select">
                    <a id="mobile_btn" href="javascript:void(0);">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <a href="/" class="navbar-brand logo">
                        <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                    </a>
                </div>

                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="/" class="menu-logo">
                            <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>

                    <ul class="main-nav">
                        <li class="has-submenu {{ request()->routeIs('welcome') ? 'active' : '' }}">
                            <a href="{{ route('welcome') }}">Accueil</a>
                        </li>

                        <li class="has-submenu {{ request()->routeIs('projects.liste') ? 'active' : '' }}">
                            <a href="{{ route('projects.liste') }}">Projets</a>
                        </li>

                        <li class="has-submenu">
                            <a href="{{ route('freelancers.liste') }}">Freelancers</a>
                        </li>
                        <li class="has-submenu">
                            <a href="{{route('Faq')}}">FAQ</a>
                        </li>

                        <li class="has-submenu">
                            <a href="javascript:void(0);">À propos <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="{{ route('contact') }}">À propos de nous</a></li>
                            </ul>
                        </li>

                        @auth
                        <li class="has-submenu">
                            <a href="javascript:void(0);">Mon espace <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li>
                                    @if (auth()->user()->user_type == 'freelancer')
                                    <a href="{{ route('freelancers.dashboard') }}">Tableau de bord</a>
                                    @else
                                    <a href="{{ route('company.dashboard') }}">Tableau de bord</a>
                                    @endif
                                </li>
                                <li>
                                    <a href="{{ route('freelancers.profile.settings') }}">Mon compte</a>
                                </li>
                                <hr>
                                <li><a href="#" class="btn_logout">Se déconnecter</a></li>
                            </ul>
                        </li>
                        @else
                        <li class="has-submenu">
                            <a href="{{ route('login') }}">Se connecter</a>
                        </li>
                        @endauth
                    </ul>
                </div>
                <ul class="nav header-navbar-rht">
                    <ul>
                        @auth
                        @if(Auth::user()->user_type !== 'freelancer')
                        <li>
                            <a href="{{ route('projects.create') }}" class="login-btn">
                                <i class="fa-solid fa-plus me-2"></i>Publier un projet
                            </a>
                        </li>
                        @else
                        <li>
                            <a href="#" class="login-btn" data-bs-toggle="modal" data-bs-target="#freelancerModal">
                                <i class="fa-solid fa-plus me-2"></i>Publier un projet
                            </a>
                        </li>
                        @endif

                        @endauth

                        {{-- if not logged in --}}
                        @guest
                        <li>
                            <a href="{{ route('projects.create') }}" class="login-btn">
                                <i class="fa-solid fa-plus me-2"></i>Publier un projet
                            </a>
                        </li>
                        @endguest
                    </ul>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="freelancerModal" tabindex="-1" aria-labelledby="freelancerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="freelancerModalLabel">Accès refusé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Désolé, vous n'êtes pas autorisé à créer un projet car vous n'êtes pas une entreprise.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <!-- FontAwesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>