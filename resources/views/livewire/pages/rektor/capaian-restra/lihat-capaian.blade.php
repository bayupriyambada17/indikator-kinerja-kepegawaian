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
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th colspan="1" style="width: 120%;">Indikator Kinerja {{ $year->year }}</th>
                            <th style="width: 5%;">Target Dep</th>
                            <th colspan="1" style="width: 120%;">Satuan</th>
                            <th style="width: 5%;">Panduan</th>
                            <th colspan="" style="width: 5%;">File Master</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fillIsiCapaian as $key => $indicator)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style=" width: 100%;">
                                    {{ $indicator['name'] }}
                                </td>
                                <td class="text-center">
                                    {{ $indicator['fill_target'] }}/{{ $indicator['faculty_targets'] }}
                                </td>
                                <td style="width: 30%" class="text-muted">
                                    {{ $indicator['unit_name'] }}
                                </td>
                                <td class="text-muted">
                                    <button class="btn btn-icon w-50 btn-info">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-info-small" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 9h.01"></path>
                                            <path d="M11 12h1v4h1"></path>
                                        </svg>
                                    </button>
                                </td>
                                <td class="text-muted">
                                    <button
                                        wire:click="file({{ $indicator['years_id'] }}, {{ $indicator['indikator_id'] }})"
                                        type="button" class="btn w-100 btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#modal-file">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-book-2" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </button>
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

        {{-- modal Rektor File Master --}}
        <div wire:ignore.self class="modal modal-blur fade" id="modal-file" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">File Master: {{ $year->year }}</h5>
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
                                                            {{ $i->bukti['name'] }}
                                                        </td>
                                                        <td class="text-secondary">
                                                            <a href="{{ asset('storage/' . $i['file_upload']) }}"
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
        {{-- modal Rektor File Master --}}
    </div>
</div>
