@section('pageTitle', $pageTitle)
<div>
    <div class="col-12">

        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Home
                </div>
                <h2 class="page-title">
                    Halaman {{ $pageTitle }}
                </h2>
            </div>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('capaian.restra') }}" class="btn btn-outline-warning">Kembali</a>
                        <button type="button" wire:click.prevent="saveData()" class="btn btn-outline-primary">Simpan
                            Data</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Indikator</th>
                            <th>Satuan</th>
                            <th>Target Fakultas</th>
                            <th class="w-1">Isi Target</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fillTargets as $key => $fill)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-muted">
                                    {{ $fill['name'] }}
                                </td>
                                <td class="text-muted">
                                    {{ $fill['unit_name'] }}
                                </td>
                                <td class="text-muted">
                                    {{ $fill['faculty_targets'] }}
                                </td>
                                <td class="text-muted">
                                    <input type="number" step="0.1"
                                        wire:model="fillTargets.{{ $key }}.fill_target"
                                        value="{{ isset($fill['fill_target']) ? $fill['fill_target'] : '' }}"
                                        inputmode="decimal" class="form-control" min="0">
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
