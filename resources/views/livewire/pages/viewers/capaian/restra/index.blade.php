@section('pageTitle', $pageTitle)
<div>
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                <h4>Halaman {{ $pageTitle }}</h4>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-center table-striped">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Jumlah Terisi IKP</th>
                            <th>Status</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($years as $item)
                            <tr>
                                <td>{{ $item->year }}</td>
                                <td class="text-muted">
                                    {{ $item->fill_target_count }}
                                </td>
                                <td class="text-muted">
                                    @if ($item->fill_target_count > 0)
                                        Telah Ter-isi
                                    @else
                                        Belum Ter-isi
                                    @endif
                                </td>

                                <td class="d-flex gap-2">
                                    <a href="{{ route('view.capaian.restra.target', $item->year) }}"
                                        class="btn btn-outline-primary">Lihat Target</a>
                                    <a href="{{ route('view.capaian.restra.capaian', $item->year) }}"
                                        class="btn btn-outline-warning">Lihat Capaian</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
