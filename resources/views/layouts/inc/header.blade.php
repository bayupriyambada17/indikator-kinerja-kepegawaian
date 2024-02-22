<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('dashboard') }}">
                {{-- <img src="{{ asset('assets/img/logoUPB.png') }}" width="50" height="50" alt="Tabler"> --}}
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            @if (auth()->user()->roles == 1)
                @include('layouts.inc.rektor.menu')
            @elseif (auth()->user()->roles == 2)
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }} ">
                            <span class="nav-link-title">
                                Dasbor
                            </span>
                        </a>
                    </li>
                    <li
                        class="nav-item dropdown {{ request()->routeIs('capaian.restra', 'lakip.add', 'capaian.ikp', 'lakip', 'capaian.ikp') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-title">
                                Monitoring & Capaian
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->routeIs('capaian.restra', 'capaian.ikp', 'lakip.add', 'capaian.ikp', 'lakip') ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->routeIs('capaian.restra') ? 'active' : '' }}"
                                        href="{{ route('capaian.restra') }}">
                                        Capaian & Target Restra
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('capaian.ikp') ? 'active' : '' }}"
                                        href="{{ route('capaian.ikp') }}">
                                        Capaian & Target IKU PTNB
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('lakip', 'lakip.add') ? 'active' : '' }}"
                                        href="{{ route('lakip') }}">
                                        LAKIP
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li
                        class="nav-item dropdown {{ request()->routeIs(
                            'year',
                            'year.add',
                            'year.edit',
                            'indikator.add',
                            'indikator.edit',
                            'indikator',
                            'satuan.indikator',
                            'satuan.indikator.add',
                            'satuan.indikator.edit',
                        )
                            ? 'active'
                            : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-title">
                                Master Data
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ request()->routeIs(
                                'year',
                                'year.add',
                                'year.edit',
                                'indikator.add',
                                'indikator.edit',
                                'indikator',
                                'satuan.indikator',
                                'satuan.indikator.add',
                                'satuan.indikator.edit',
                                'capaian.indikator',
                                'bukti-upload',
                            )
                                ? 'show'
                                : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->routeIs('year') ? 'active' : '' }}"
                                        href="{{ route('year') }}">
                                        Tahun Indikator
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('bukti-upload') ? 'active' : '' }}"
                                        href="{{ route('bukti-upload') }}">
                                        Data Bukti Upload
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('capaian.indikator') ? 'active' : '' }}"
                                        href="{{ route('capaian.indikator') }}">
                                        Capaian Indikator IKP
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('indikator') ? 'active' : '' }}"
                                        href="{{ route('indikator') }}">
                                        Indikator
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('satuan.indikator') ? 'active' : '' }}"
                                        href="{{ route('satuan.indikator') }}">
                                        Satuan Indikator
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        @livewire('pages.operator.logout')
                    </li>
                </ul>
            @endif
        </div>
    </div>
</aside>
