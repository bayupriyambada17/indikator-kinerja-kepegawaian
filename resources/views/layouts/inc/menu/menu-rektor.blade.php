<ul class="navbar-nav pt-lg-3">
    <li class="nav-item {{ request()->routeIs('rektor.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="
                    {{ route('rektor.dashboard') }}
                    ">
            <span class="nav-link-title">
                Dasbor
            </span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('rektor.capaian-restra') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('rektor.capaian-restra') }}">
            <span class="nav-link-title">
                Capaian Target & Capaian Restra
            </span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('rektor.capaian-iku') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('rektor.capaian-iku') }}">
            <span class="nav-link-title">
                Capaian & Target IKU PTNB
            </span>
        </a>
    </li>
    <li class="nav-item">
        @livewire('pages.operator.logout')
    </li>
</ul>
