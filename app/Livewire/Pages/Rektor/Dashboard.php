<?php

namespace App\Livewire\Pages\Rektor;

use App\Models\IsiTarget;
use App\Models\Lakip;
use App\Models\Year;
use Livewire\Component;

class Dashboard extends Component
{
    public $pageTitle = 'Dashboard Rektor';
    public function render()
    {
        // $yearsRestra = Year::with('capaianRetraUpload', 'fillTarget.indicators')->get()->toArray();
        // dd($yearsRestra);
        // Ambil data tahun dari model Year
        // Ambil data tahun dari model Year
        // $years = Year::all();

        // // Siapkan array untuk menyimpan data fill target
        // $fillTargetsData = [];

        // // Ambil data fill target untuk setiap tahun dari model FillTarget
        // foreach ($years as $year) {
        //     $fillTargets = IsiTarget::where('years_id', $year->id)->get();

        //     // Simpan data fill target ke dalam array
        //     $fillTargetsData[$year->year] = $fillTargets->pluck('fill_target');
        // }

        // // Siapkan data yang akan digunakan untuk grafik
        // $chartData = [
        //     'labels' => $years->pluck('year'),
        //     'data' => $fillTargetsData,
        // ];

        // dd($chartData);


        $yearsRestra = Year::select('id', 'year')->withCount('fillTarget')->get()->toArray();
        // dd($yearsRestra);
        $lakips = Lakip::with('years:id,year')->get();
        return view('livewire.pages.rektor.dashboard', [
            'lakips' => $lakips
        ])->layout('layouts.app');
    }
}
