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
                <table class="table table-vcenter table-bordered card-table text-center">
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
                                    <a href="{{ route('capaian.restra.isi-target', $item->year) }}"
                                        class="btn btn-outline-primary">Isi Target</a>
                                    <a href="{{ route('capaian.restra.isi-capaian', $item->year) }}"
                                        class="btn btn-outline-warning">Isi Capaian</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
