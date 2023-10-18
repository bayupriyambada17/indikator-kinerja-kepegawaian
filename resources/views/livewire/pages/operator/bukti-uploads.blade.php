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
        <a href="{{ route('bukti-upload.add') }}" class="btn btn-primary mb-3">Tambah Data</a>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Indikator</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buktiUploads as $bukti)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-muted">
                                    {{ $bukti->name }}
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('bukti-upload.edit', $bukti->id) }}"
                                        class="btn btn-primary">Ubah</a>
                                    <a href="#" wire:click.prevent="destroy({{ $bukti->id }})"
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
