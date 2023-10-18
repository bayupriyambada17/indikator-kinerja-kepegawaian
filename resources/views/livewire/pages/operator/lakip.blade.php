@section('pageTitle', $pageTitle)
<div>
    <div class="col-12">
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
        <a href="{{ route('lakip.add') }}" class="btn btn-primary mb-3">Tambah Data</a>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tahun</th>
                            <th>Waktu Unggah</th>
                            <th>Docs</th>
                            <th>Pdf</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lakips as $lakip)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-muted">
                                    {{ $lakip->years->year }}
                                </td>
                                <td class="text-muted">
                                    {{ $lakip->upload_times }}
                                </td>
                                <td class="text-muted">
                                    <a href="{{ asset('storage/' . $lakip->pdf) }}" target="_blank"
                                        class="btn btn-primary btn-sm">Lihat Pdf</a>
                                </td>
                                <td class="text-muted">
                                    <a href="{{ asset('storage/' . $lakip->docs) }}" target="_blank"
                                        class="btn btn-warning btn-sm">Docs</a>
                                </td>
                                <td class="d-flex gap-2">
                                    {{-- <a href="{{ route('indikator.edit', $lakip->id) }}"
                                        class="btn btn-primary">Ubah</a> --}}
                                    <a href="#" wire:click.prevent="destroy({{ $lakip->id }})"
                                        class="btn btn-warning">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
