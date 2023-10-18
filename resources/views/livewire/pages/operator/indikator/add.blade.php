@section('pageTitle', 'Tambah Indikator Kinerja')
<div>
    <div class="card mb-3">
        <div class="card-body">
            <h4>Halaman {{ $pageTitle }}</h4>
        </div>
    </div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <a href="{{ route('indikator') }}" class="btn btn-info mb-3">Kembali</a>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row row-cards">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Nama Indikator</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama indikator"
                                        wire:model="name.0">
                                </div>
                                @error('name.0')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="mb-">
                                    <label class="form-label required">Pilih Satuan</label>
                                    <select class="form-control" wire:model="satuan_id.0">
                                        <option value="">Pilih Nama Satuan</option>
                                        @foreach ($unitIndicators as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('satuan_id.0')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label required">Target Fakultas</label>
                                    <input type="number" step="0.1" inputmode="decimal" class="form-control"
                                        placeholder="Masukan Target (Angka)" wire:model="faculty_targets.0">
                                </div>
                                @error('faculty_targets.0')
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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label required">Nama Indikator</label>
                                        <input type="text" class="form-control" placeholder="Masukkan nama indikator"
                                            wire:model="name.{{ $key + 1 }}">
                                    </div>
                                    @error('name.' . $key + 1)
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-">
                                        <label class="form-label required">Pilih Satuan</label>
                                        <select class="form-control" wire:model="satuan_id.{{ $key + 1 }}">
                                            <option value="">Pilih Nama Satuan</option>
                                            @foreach ($unitIndicators as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('satuan_id.' . $key + 1)
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label required">Target Fakultas</label>
                                        <input type="number" step="0.1" inputmode="decimal" class="form-control"
                                            placeholder="Masukan Target (Angka)"
                                            wire:model="faculty_targets.{{ $key + 1 }}">
                                    </div>
                                    @error('faculty_targets.' . $key + 1)
                                        <span class="text-danger error">{{ $message }}</span>
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
