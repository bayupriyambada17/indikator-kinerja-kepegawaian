<ul class="navbar-nav pt-lg-3">
    <li class="nav-item {{ request()->routeIs('view.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('view.dashboard') }}
                    ">
            <span class="nav-link-title">
                Dasbor
            </span>
        </a>
    </li>
    <li
        class="nav-item dropdown {{ request()->routeIs('view.*') ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false"
            role="button" aria-expanded="false">
            <span class="nav-link-title">
                Monitoring & Capaian
            </span>
        </a>
        <div
            class="dropdown-menu {{ request()->routeIs('view.capaian.iku', 'view.capaian.restra') ? 'show' : '' }}">
            <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                    <a class="dropdown-item {{ request()->routeIs('view.capaian.iku') ? 'active' : '' }}"
                        href="{{ route('view.capaian.iku') }}">
                        Capaian & Target IKU
                    </a>
                    <a class="dropdown-item {{ request()->routeIs('view.capaian.restra') ? 'active' : '' }}"
                        href="{{ route('view.capaian.restra') }}">
                        Capaian & Target Restra
                    </a>
                    {{-- <a class="dropdown-item {{ request()->routeIs('capaian.ikp') ? 'active' : '' }}"
                        href="{{ route('capaian.ikp') }}">
                        Capaian & Target IKU PTNB
                    </a>
                    <a class="dropdown-item {{ request()->routeIs('lakip', 'lakip.add') ? 'active' : '' }}"
                        href="{{ route('lakip') }}">
                        LAKIP
                    </a> --}}
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item">
        @livewire('pages.operator.logout')
    </li>
</ul>
