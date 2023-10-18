@section('pageTitle', 'Edit Indikator Kinerja')
<div>
    <a href="{{ route('capaian.ikp') }}" class="btn btn-info mb-3">Kembali</a>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="updateData()">
                        <div class="row row-cards">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Nama Indikator</label>
                                    <textarea cols="20" rows="5" class="form-control" wire:model="name"></textarea>
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Pilih Satuan</label>
                                    <select class="form-control" wire:model="satuan_id">
                                        <option value="">Pilih Nama Satuan</option>
                                        @foreach ($unitIndicators as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('satuan_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label required">Target Fakultas</label>
                                    <input type="number" step="0.1" inputmode="decimal" class="form-control"
                                        placeholder="Masukan Target (Angka)" wire:model="faculty_targets">
                                </div>
                                @error('faculty_targets')
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
