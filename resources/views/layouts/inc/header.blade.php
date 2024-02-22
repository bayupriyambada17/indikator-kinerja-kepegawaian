<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/img/logoUPB.png') }}" width="50" height="50" alt="Tabler">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            @if (auth()->user()->roles == 1)
                @include('layouts.inc.menu.menu-rektor')
            @elseif (auth()->user()->roles == 2)
                @include('layouts.inc.menu.menu-operator')
            @elseif (auth()->user()->roles == 4)
                @include('layouts.inc.menu.menu-viewers')
            @endif

        </div>
    </div>
</aside>
