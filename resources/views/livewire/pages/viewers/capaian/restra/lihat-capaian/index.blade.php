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

    </div>
</div>
