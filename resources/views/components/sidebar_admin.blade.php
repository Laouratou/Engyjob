<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                {{-- <li class="menu-title"><span>Main</span></li> --}}
                <li class="@if (request()->routeIs('dashboard')) active @endif">
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="@if (request()->routeIs('categories.index')) active @endif">
                    <a href="{{ route('categories.index') }}">
                        <i data-feather="copy"></i>
                        <span>Catégories</span>
                    </a>
                </li>
                <li class="@if (request()->routeIs('admin_get_all_projects')) active @endif">
                    <a href="{{ route('admin_get_all_projects') }}">
                        <i data-feather="database"></i>
                        <span>Projets</span>
                    </a>
                </li>
                <li class="@if (request()->routeIs('admin_get_all_freelancers')) active @endif">
                    <a href="{{ route('admin_get_all_freelancers') }}">
                        <i data-feather="users"></i>
                        <span>Freelancers</span>
                    </a>
                </li>
                <li class="@if (request()->routeIs('admin_get_all_companies')) active @endif">
                    <a href="{{ route('admin_get_all_companies') }}">
                        <i data-feather="user-check"></i>
                        <span>Entreprises</span>
                    </a>
                </li>
                <li>
                    <a href="#"><i data-feather="user-check"></i> <span>Dépôts</span></a>
                </li>
                <li>
                    <a href="#"><i data-feather="user-check"></i> <span>Retraits</span></a>
                </li>
                <li>
                    <a href="#"><i data-feather="clipboard"></i> <span>Transactions</span></a>
                </li>
                <li class="@if (request()->routeIs('admin_get_all_memberships')) active @endif">
                    <a href="{{ route('admin_get_all_memberships') }}">
                        <i data-feather="user-check"></i> <span>Souscription</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i data-feather="pie-chart">
                        </i> <span>Rapports</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i data-feather="clipboard">
                        </i> <span>Rôles & permissions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('skills.index') }}">
                        <i data-feather="award"></i>
                        <span>Compétences</span>
                    </a>
                </li>
                <li class="@if (request()->routeIs('admin_get_all_id_verifications')) active @endif">
                    <a href="{{ route('admin_get_all_id_verifications') }}">
                        <i data-feather="user-check"></i>
                        <span>Vérification
                            d'identité</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i data-feather="settings"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
                <li class="menu-title"><span>Configuration</span></li>
                <li class="submenu ">
                    <a href="javascript:void(0);">
                        <i data-feather="file-minus"></i>
                        <span> Langues</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li class="">
                            <a href="{{ route('project_languages.index') }}">Liste</a>
                        </li>
                        <li>
                            <a href="{{ route('project_languages_levels.index') }}">Niveaux</a>
                        </li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i data-feather="align-justify"></i>
                        <span> Freelancers</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('freelancer_types.index') }}">Types</a></li>
                        <li><a href="{{ route('freelancer_levels.index') }}">Niveaux</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i data-feather="align-justify"></i>
                        <span> Durées</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('project_durations.index') }}">Liste</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i data-feather="align-justify"></i>
                        <span> Services</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('services.create') }}">Ajouter services</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i data-feather="align-justify"></i>
                        <span> Plans</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('plans.create') }}">Ajouter plans</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);">
                        <i data-feather="align-justify"></i>
                        <span> Config</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('configs.create') }}">Ajouter des configurations</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>