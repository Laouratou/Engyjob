<div class="col-xl-3 col-lg-4 theiaStickySidebar">
    <div class="settings-widget">
        <div class="settings-header d-sm-flex flex-row flex-wrap text-center text-sm-start align-items-center">
            <a href="{{ route('freelancers.profile.settings') }}">
                @if (Auth::user()->profil)
                    <img alt="profile image" src="{{ asset(Auth::user()->profil->photo ?: 'path_to_placeholder_image.jpg') }}"
                        class="avatar-lg rounded-circle">
                @else
                    <!-- Placeholder image or default avatar -->
                    <img alt="profile image" src="{{ asset('path_to_placeholder_image.jpg') }}"
                        class="avatar-lg rounded-circle">
                @endif
            </a>
            <div class="ms-sm-3 ms-md-0 ms-lg-3 mt-2 mt-sm-0 mt-md-2 mt-lg-0">
                <h4 class="mb-0"><a href="profile-settings.html">
                    {{ Str::substr(Auth::user()->name . ' ' . Auth::user()->first_name, 0, 13) }}
                </a>
                @if (Auth::user()->profil && Auth::user()->profil->is_verified)
                    <img src="/assets/img/icon/verified-badge.svg" class="ms-1" alt="Verified Badge">
                @endif
                </h4>
                @if (Auth::user()->profil)
                    <p class="mb-0">{{ '@' . Auth::user()->profil->username }}</p>
                @endif
            </div>
        </div>
        <div class="settings-menu">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="nav-item {{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('company.dashboard') }}">
                            <img src="/assets/img/icon/sidebar-icon-01.svg" alt="Dashboard Icon"> Dashboard
                        </a>
                    </li>
                    <li class="nav-item submenu {{ request()->routeIs('company.all_projects', 'company.projects.*') ? 'active' : '' }}">
                        <a href="#" class="nav-link">
                            <img src="/assets/img/icon/sidebar-icon-02.svg" alt="Projects Icon"> Projects
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="sub-menu-ul">
                            <li>
                                <a class="{{ request()->routeIs('company.all_projects') ? 'active' : '' }}"
                                    href="{{ route('company.all_projects') }}">Tous les projets</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('company.projects.ongoing_projects') ? 'active' : '' }}"
                                    href="{{ route('company.projects.ongoing_projects') }}">Projets en cours</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('company.projects.completed_projects') ? 'active' : '' }}"
                                    href="{{ route('company.projects.completed_projects') }}">Projets terminés</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('company.projects.pending_projects') ? 'active' : '' }}"
                                    href="{{ route('company.projects.pending_projects') }}">Projets en attente</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('company.projects.cancelled_projects') ? 'active' : '' }}"
                                    href="{{ route('company.projects.cancelled_projects') }}">Projets annulés</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('company.projects.expired_projects') ? 'active' : '' }}"
                                    href="{{ route('company.projects.expired_projects') }}">Projets expirés</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                        <a href="{{ route('favorites.index') }}">Projets en signet</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('company.reviews') ? 'active' : '' }}">
                        <a href="{{ route('company.reviews') }}">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-04.svg') }}" alt="Reviews Icon"> Commentaires
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('wallet_transactions.index') ? 'active' : '' }}">
                        <a href="{{ route('wallet_transactions.index') }}">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-07.svg') }}" alt="Wallet Icon"> Portefeuille
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('company.user_payments') ? 'active' : '' }}">
                        <a href="{{ route('company.user_payments') }}">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-07.svg') }}" alt="Payments Icon"> Paiements
                        </a>
                    </li>
                    <li class="nav-item submenu">
                        <a href="javascript:void(0);" class="nav-link">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-10.svg') }}" alt="Settings Icon"> Paramètres
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="sub-menu-ul">
                            <li>
                                <a class="{{ request()->routeIs('freelancers.profile.settings') ? 'active' : '' }}"
                                    href="{{ route('freelancers.profile.settings') }}">Profil</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('verify_identity') ? 'active' : '' }}"
                                    href="{{ route('verify_identity') }}">Vérifiez votre identité</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('change_password') ? 'active' : '' }}"
                                    href="{{ route('change_password') }}">Changer de mot de passe</a>
                            </li>
                            <li>
                                <a href="#">Supprimer mon compte</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link btn_logout">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-11.svg') }}" alt="Logout Icon"> Se déconnecter
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
