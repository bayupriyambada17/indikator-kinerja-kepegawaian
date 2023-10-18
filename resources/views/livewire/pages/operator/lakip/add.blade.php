@section('pageTitle', 'Tambah LAKIP')
<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <h4>Halaman {{ $pageTitle }}</h4>
        </div>
    </div>
    <a href="{{ route('lakip') }}" class="btn btn-info mb-3">Kembali</a>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="row row-cards">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Tahun LAKIP</label>
                                    <select class="form-control" wire:model="years_id">
                                        <option value="">Pilih Tahun</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('years_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">File PDF.</label>
                                    <input type="file" class="form-control" wire:model="pdf">
                                    <small class="form-hint">Berkas yang di unggah format .pdf dan Ukuran maksimal 10 MB
                                        , jika lebih dari 10 MB mohon dapat melakukan kompresi pdf terlebih
                                        dahulu.</small>
                                </div>
                                @error('pdf')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">File DOCS.</label>
                                    <input type="file" class="form-control" wire:model="docs">
                                    <small class="form-hint">Berkas yang di unggah format .docx dan Ukuran maksimal 10
                                        MB , jika lebih dari 10 MB mohon dapat melakukan kompresi terlebih
                                        dahulu.</small>
                                </div>
                                @error('docs')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Simpan
                                    Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
