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
                <table class="table table-vcenter table-bordered card-table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Indikator Kinerja {{ $year->year }}</th>
                            <th>Target Dep</th>
                            <th>Satuan</th>
                            <th>Panduan</th>
                            @if (auth()->user()->roles == 1)
                                <th>File Master</th>
                            @endif
                            @if (auth()->user()->roles == 2)
                                <th>Capaian Dep</th>
                            @endif
                            <th>Komentar</th>
                            @if (auth()->user()->roles == 2)
                                <th>Valid</th>
                            @endif
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fillIsiCapaian as $key => $indicator)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style=" width: 25%;">
                                    {{ $indicator['name'] }}
                                </td>
                                <td style="width: 3%" class="text-center">
                                    {{ $indicator['fill_target'] }}/{{ $indicator['faculty_targets'] }}
                                </td>
                                <td style="width: 10%" class="text-muted">
                                    {{ $indicator['unit_name'] }}
                                </td>
                                <td class="text-muted" wire:ignore>
                                    <button class="btn btn-outline-info w-100">
                                        <i data-lucide="book-open-check" class="w-4 h-4"></i>
                                    </button>
                                </td>
                                @if (auth()->user()->roles == 1)
                                    <td class="text-muted" wire:ignore>
                                        <button
                                            wire:click="file({{ $indicator['years_id'] }}, {{ $indicator['indikator_id'] }})"
                                            type="button" class="btn btn-outline-success w-100" data-bs-toggle="modal"
                                            data-bs-target="#modal-file">
                                            <i data-lucide="upload" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                @endif
                                @if (auth()->user()->roles == 2)
                                    <td class="d-flex gap-2 text-center" wire:ignore>
                                        <button
                                            wire:click="prepareFindUpload({{ $indicator['years_id'] }}, {{ $indicator['indikator_id'] }})"
                                            type="button" class="btn w-100 btn-icon" data-bs-toggle="modal"
                                            data-bs-target="#modal-report">
                                            <i data-lucide="upload" class="w-4 h-4"></i>

                                        </button>
                                    </td>
                                @endif
                                <td>
                                    <button
                                        wire:click="prepareComment({{ $indicator['years_id'] }}, {{ $indicator['indikator_id'] }})"
                                        type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#modal-comment">Berikan Komentar</button>
                                </td>
                                @if (auth()->user()->roles == 2)
                                    <td>
                                        @if ($indicator['isiCapaian'][0]['isValid'] ?? 0)
                                            <button class="btn btn-success btn-icon" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-circle-check" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                    <path d="M9 12l2 2l4 -4"></path>
                                                </svg>
                                            </button>
                                        @else
                                            <button
                                                wire:click.prevent="validation({{ $indicator['years_id'] }}, {{ $indicator['indikator_id'] }})"
                                                class="btn w-100 btn-icon outline- gap-3">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-hand-click" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M8 13v-8.5a1.5 1.5 0 0 1 3 0v7.5"></path>
                                                    <path d="M11 11.5v-2a1.5 1.5 0 0 1 3 0v2.5"></path>
                                                    <path d="M14 10.5a1.5 1.5 0 0 1 3 0v1.5"></path>
                                                    <path
                                                        d="M17 11.5a1.5 1.5 0 0 1 3 0v4.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7l-.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47">
                                                    </path>
                                                    <path d="M5 3l-1 -1"></path>
                                                    <path d="M4 7h-1"></path>
                                                    <path d="M14 3l1 -1"></path>
                                                    <path d="M15 6h1"></path>
                                                </svg>
                                            </button>
                                        @endif
                                    </td>
                                @endif
                                @php
                                    $percentage = ($indicator['fill_target'] / $indicator['faculty_targets']) * 100;
                                @endphp
                                <td style="width:3%; @if ($percentage > 50) background-color: green; @else background-color: red; @endif color: whitesmoke; text-align: center;"
                                    class="text-center">

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
                        <div class="mb-3">
                            <label class="form-label">Judul File </label>
                            <input type="text" class="form-control" wire:model="judul_file" required>
                            @error('judul_file')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Pilih Bukti Upload</label>
                            <select class="form-control" wire:model="bukti_upload_id" required>
                                <option value="">Pilih Bukti Upload</option>
                                @foreach ($buktiUploads as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('bukti_upload_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Capaian Dokumen (PDF)</label>
                            <input type="file" class="form-control" wire:model="file_upload" required>
                            @error('file_upload')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <button wire:click.prevent="createUpload()" type="button" class="btn btn-primary">Upload
                            Bukti</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-bordered card-table">
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
                                                            <a href="{{ asset('bukti_upload_restra/' . $i['file_upload']) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">Lihat
                                                                Bukti Upload</a>
                                                        </td>
                                                        <td class="text-secondary">
                                                            {{ $i['created_at'] }}
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                wire:click.prevent="destroyUpload({{ $i['id'] }})"
                                                                class="btn btn-danger btn-sm">Hapus
                                                                Bukti</button>
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
        {{-- modal Comment --}}
        <div wire:ignore.self class="modal modal-blur fade" id="modal-comment" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Komentar Isi Capaian: {{ $year->year }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($comment)
                            <div class="mb-3">
                                <button class="btn btn-secondary mt-2" wire:click.prevent="editComment()"> Perbaharui
                                    {{ $comment->comment }}</button>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="form-label">Komentar</label>
                                <input type="text" class="form-control" wire:model="comment" required>
                                @error('comment')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-2" wire:click.prevent="createComment()">Simpan
                                Komentar</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- modal Comment --}}
        {{-- modal Rektor File Master --}}
        <div wire:ignore.self class="modal modal-blur fade" id="modal-file" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">File Master: {{ $year->year }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
                                                        <td>
                                                            <button type="button"
                                                                wire:click.prevent="destroyUpload({{ $i['id'] }})"
                                                                class="btn btn-danger btn-sm">Hapus
                                                                Bukti</button>
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
