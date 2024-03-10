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
        <a href="{{ route('year.add') }}" class="btn btn-outline-primary mb-3">Tambah Data</a>
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
                        @foreach ($years as $year)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-muted">
                                    {{ $year->year }}
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('year.edit', $year->id) }}" class="btn btn-outline-primary">Ubah</a>
                                    <a href="#" wire:click.prevent="destroy({{ $year->id }})"
                                        class="btn btn-outline-warning">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
