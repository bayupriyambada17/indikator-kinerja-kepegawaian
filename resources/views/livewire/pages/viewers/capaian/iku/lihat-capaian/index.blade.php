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
                            @if (auth()->user()->roles == 1)
                                <th style="width: 5%;">File Master</th>
                            @endif
                            @if (auth()->user()->roles == 2)
                                <th class="w-1">Capaian Dep</th>
                            @endif
                            <th style="width: 70%;">Komentar</th>
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
                                <td style=" width: 100%;">
                                    {{ $indicator['name'] }}
                                </td>
                                <td class="text-center">
                                    {{ $indicator['fill_target'] }}/{{ $indicator['faculty_targets'] }}
                                </td>
                                <td style="width: 30%" class="text-muted">
                                    {{ $indicator['unit_name'] }}
                                </td>

                                <td>

                                    <ul>
                                        @foreach ($indicator['isiCapaian'] as $isi)
                                        <li>{{ $isi->comment }}</li>
                                        @endforeach
                                    </ul>
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
    </div>
</div>
