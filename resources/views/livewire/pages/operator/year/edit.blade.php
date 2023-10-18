@section('pageTitle', 'Ubah Tahun Kinerja')
<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <a href="{{ route('year') }}" class="btn btn-info mb-3">Kembali</a>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="updateData">
                        <div class="row row-cards">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label required">Tahun Kinerja.</label>
                                    <input type="text" class="form-control" wire:model="year">
                                </div>
                                @error('year')
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
