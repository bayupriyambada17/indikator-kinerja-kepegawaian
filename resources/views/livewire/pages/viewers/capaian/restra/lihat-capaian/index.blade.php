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
                <table class="table table-bordered card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 70%;">Indikator Kinerja {{ $year->year }}</th>
                            <th style="width: 5%;">Target Dep</th>
                            <th style="width: 120%;">Satuan</th>
                            <th style="width: 120%;">Dokumen</th>
                            <th style="width: 120%;">Komentar</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fillIsiCapaian as $key => $indicator)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $indicator['name'] }}
                                </td>
                                <td>
                                    {{ $indicator['fill_target'] }}/{{ $indicator['faculty_targets'] }}
                                </td>
                                <td>
                                    {{ $indicator['unit_name'] }}
                                </td>
                                <td class="d-flex gap-2 text-center">
                                    <button
                                        wire:click="prepareFindUpload({{ $indicator['years_id'] }}, {{ $indicator['indikator_id'] }})"
                                        type="button" class="btn w-100 btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#modal-report">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-upload" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                            <path d="M7 9l5 -5l5 5"></path>
                                            <path d="M12 4l0 12"></path>
                                        </svg>
                                    </button>
                                </td>
                                <td>
                                    @foreach ($indicator['isiCapaian'] ?? [] as $item)
                                        <li>{{ $item->comment }}</li>
                                    @endforeach
                                </td>
                                @php
                                    $percentage = ($indicator['fill_target'] / $indicator['faculty_targets']) * 100;
                                @endphp
                                <td
                                    style="width: 30%; text-align: center; @if ($percentage > 50) background-color: green; @else background-color: red; @endif color: whitesmoke;">

                                    {{ number_format(round($percentage, 1)) }}%
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- modal CAPAIAN DEP --}}
        <div wire:ignore.self class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Capaian Departemen {{ $year->year }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul File</th>
                                                <th>Bukti Upload</th>
                                                <th>Lampiran File</th>
                                                <th>Waktu Upload</th>
                                                <th class="w-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($selectedFillIsiCapaian)
                                                @foreach ($selectedFillIsiCapaian->capaianRetraUpload as $i)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="text-secondary">
                                                            {{ $i->judul_file }}
                                                        </td>
                                                        <td class="text-secondary">
                                                            {{ $i->bukti['name'] }}
                                                        </td>
                                                        <td class="text-secondary">
                                                            <a href="{{ asset('bukti_upload_iku/' . $i['file_upload']) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">Lihat
                                                                Bukti Upload</a>
                                                        </td>
                                                        <td class="text-secondary">
                                                            {{ $i['created_at'] }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal CAPAIAN DEP --}}

    </div>
</div>
