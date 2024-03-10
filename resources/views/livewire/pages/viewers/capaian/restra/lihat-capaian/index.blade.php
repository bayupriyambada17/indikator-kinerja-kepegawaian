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
                <table class="table table-bordered table-vcenter card-table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 30%;">Indikator Kinerja {{ $year->year }}</th>
                            <th style="width: 5%;">Target Dep</th>
                            <th style="width: 20%;">Satuan</th>
                            <th style="width: 10%;">Dokumen</th>
                            <th style="width: 100%;">Komentar</th>
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
                                <td class="d-flex gap-2 text-center" wire:ignore>
                                    <button
                                        wire:click="prepareFindUpload({{ $indicator['years_id'] }}, {{ $indicator['indikator_id'] }})"
                                        type="button" class="btn w-100 btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#modal-report">
                                        <i data-lucide="file" class="h-4 w-4"></i>
                                    </button>
                                </td>
                                <td>

                                    @foreach ($indicator['isiCapaian'] ?? [] as $item)
                                        {{ $item ?? [] }}

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
