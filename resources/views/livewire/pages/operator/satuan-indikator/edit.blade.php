@section('pageTitle', 'Edit Satuan Indikator Kinerja')
<div>
    <a href="{{ route('satuan.indikator') }}" class="btn btn-outline-info mb-3">Kembali</a>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="updateData()">
                        <div class="row row-cards">
                            <div class="col-md-12   ">
                                <div class="mb-3">
                                    <label class="form-label required">Nama Satuan</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama satuan"
                                        wire:model="name">
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Perbaharui
                                    Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
