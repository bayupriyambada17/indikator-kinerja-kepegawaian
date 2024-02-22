@section('pageTitle', $pageTitle)
<div>
    <div class="card mb-3">
        <div class="card-body">
            <h4>Halaman {{ $pageTitle }}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p><b>{{ auth()->user()->name }}!</b> Selamat datang di aplikasi Indikator Kinerja Pelita Bangsa</p>
        </div>
    </div>
    <div class="card mt-3">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tahun</th>
                        <th>Waktu Unggah</th>
                        <th>Pdf</th>
                        <th>Docx</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($lakips as $lakip)
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
                                    class="btn btn-warning btn-sm">Lihat Dokumen</a>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
