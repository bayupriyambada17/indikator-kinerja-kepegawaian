@section('pageTitle', 'Halaman Masuk')
<div>
    <div class="row g-0 flex-fill">
        <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="container container-tight my-5 px-lg-5">
                <div class="text-center mb-4">
                    <a href="." class="navbar-brand navbar-brand-autodark"><img
                            src="{{ asset('assets/img/logoUPB.png') }}" height="36" alt=""></a>
                </div>
                <h2 class="h3 text-center mb-3">
                    Masuk dengan akun anda!
                </h2>
                <form wire:submit.prevent="login()" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input wire:model="email" type="email" class="form-control" placeholder="Alamat Email..."
                            autocomplete="off">
                        @error('email')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            Kata Sandi
                        </label>
                        <div class="input-group input-group-flat">
                            <input wire:model="password" type="password" class="form-control"
                                placeholder="Masukkan kata sandi..." autocomplete="off">
                            @error('password')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Masuk Aplikasi IKU</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
            <!-- Photo -->
            <div class="bg-cover h-100 min-vh-100" style="background-image: url({{ asset('assets/img/banner.webp') }})">
            </div>
        </div>
    </div>
</div>
