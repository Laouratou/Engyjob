<div class="col-xl-3 col-lg-4 theiaStickySidebar">
    <div class="settings-widget">
        <div class="settings-header d-sm-flex flex-row flex-wrap text-center text-sm-start align-items-center">
            <a href="{{ route('freelancers.profile.settings') }}">
                <img alt="profile image" src="{{ asset(Auth::user()->profil->photo) }}"
                    class="avatar-lg rounded-circle"></a>
            <div class="ms-sm-3 ms-md-0 ms-lg-3 mt-2 mt-sm-0 mt-md-2 mt-lg-0">
                <h4 class="mb-0"><a href="profile-settings.html">{{ Str::substr(Auth::user()->name . ' ' .
                        Auth::user()->first_name, 0, 13) }}
                    </a>
                    @if (Auth::user()->profil->is_verified)
                    <img src="/assets/img/icon/verified-badge.svg" class="ms-1" alt="Img">
                    @endif
                </h4>
                <p class="mb-0">{{ '@' . Auth::user()->profil->username }}</p>
            </div>
        </div>
        <div class="settings-menu">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('freelancers.dashboard') }}"
                            class="nav-link {{ request()->routeIs('freelancers.dashboard') ? 'active' : '' }}">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-01.svg') }}" alt="Img"> Dashboard

                        </a>
                    </li>
                    <li class="nav-item submenu">
                        <a href="#" class="nav-link">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-02.svg') }}" alt="Img"> Projects
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="sub-menu-ul">
                            <li>
                                <a class=" @if (request()->routeIs('freelancers.my_proposals') ||
                                        request()->routeIs('freelancers.projects.details') ||
                                        request()->routeIs('freelancers.projects.manage_etape_cles') ||
                                        request()->routeIs('freelancers.projects.manage_tasks') ||
                                        request()->routeIs('freelancers.projects.project_files')) active @endif"
                                    href="{{ route('freelancers.my_proposals') }}">
                                    Mes propositions
                                </a>
                            </li>
                            <li>
                                <a class="@if (request()->routeIs('freelancers.projects.ongoing_projects')) active @endif"
                                    href="{{ route('freelancers.projects.ongoing_projects') }}">Projets en cours</a>
                            </li>
                            <li>
                                <a class="@if (request()->routeIs('freelancers.projects.completed_projects')) active @endif"
                                    href="{{ route('freelancers.projects.completed_projects') }}">Projets terminés</a>
                            </li>

                            <li>
                                <a class="@if (request()->routeIs('freelancers.projects.cancelled_projects')) active @endif"
                                    href="{{ route('freelancers.projects.cancelled_projects') }}">Projets annulés</a>
                            </li>
                            <li>
                                <a class="@if (request()->routeIs('freelancers.projects.expired_projects')) active @endif"
                                    href="{{ route('freelancers.projects.expired_projects') }}">Projets expirés</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                        <a href="{{ route('favorites.index') }}">Projets en signet</a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('freelancers.reviews') }}"
                            class="nav-link {{ request()->routeIs('freelancers.reviews') ? 'active' : '' }}">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-04.svg') }}" alt="Img"> Commentaires
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('wallet_transactions.index') }}"
                            class="nav-link {{ request()->routeIs('wallet_transactions.index') ? 'active' : '' }}">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-07.svg') }}" alt="Img"> Portefeuille
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('freelancers.user_payments') }}"
                            class="nav-link {{ request()->routeIs('freelancers.user_payments') ? 'active' : '' }}">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-07.svg') }}" alt="Img"> Paiements
                        </a>
                    </li>
                    <li class="nav-item submenu">
                        <a href="javascript:void(0);" class="nav-link">
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-10.svg') }}" alt="Img"> Paramètres
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="sub-menu-ul">
                            <li>
                                <a class="{{ request()->routeIs('freelancers.profile.settings') ? 'active' : '' }}"
                                    href="{{ route('freelancers.profile.settings') }}">Profil</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('freelancers.membership') ? 'active' : '' }}"
                                    href="{{ route('freelancers.membership') }}">Plan et facturation</a>
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
                            <img src="{{ asset('/assets/img/icon/sidebar-icon-11.svg') }}" alt="Img"> Se
                            déconnecter
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>