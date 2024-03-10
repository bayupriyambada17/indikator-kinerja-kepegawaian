@section('pageTitle', 'Tambah Satuan Indikator Kinerja')
<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <a href="{{ route('satuan.indikator') }}" class="btn btn-outline-info mb-3">Kembali</a>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row row-cards">
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <label class="form-label required">Nama Satuan</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama satuan"
                                        wire:model="name.0">
                                </div>
                                @error('name.0')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Aksi</label>
                                    <Button wire:click.prevent="add()" class="btn btn-primary">Tambah</Button>
                                </div>
                            </div>

                            @foreach ($inputs as $key => $value)
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <label class="form-label required">Nama Satuan</label>
                                        <input type="text" class="form-control" wire:model="name.{{ $key + 1 }}"
                                            placeholder="Masukkan nama satuan">
                                    </div>
                                    @error('name.' . $key + 1)
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">Aksi</label>
                                        <Button wire:click.prevent="add()" class="btn btn-primary">+</Button>
                                        <Button wire:click.prevent="remove({{ $key }})"
                                            class="btn btn-danger">-</Button>
                                    </div>
                                </div>
                            @endforeach
                            <div>
                                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Simpan
                                    Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
