<?php

namespace App\Livewire\Pages\Rektor\CapaianRestra;

use App\Models\Year;
use Livewire\Component;
use App\Models\Indikator;
use App\Models\BuktiUpload;

class LihatCapaian extends Component
{
    public $pageTitle;
    public $year;
    public $fillIsiCapaian;
    public $indicators;
    public $buktiUploads;
    public $bukti_upload_id;

    public $selectedFillIsiCapaian = null; // Properti untuk menyimpan data yang akan ditampilkan di modal
    public $selectedYearsId; // Properti untuk menyimpan data yang akan ditampilkan di modal
    public $selectedIndikatorId; // Properti untuk menyimpan data yang akan ditampilkan di modal

    public function mount($year)
    {
        $this->buktiUploads = BuktiUpload::get();
        $this->pageTitle = 'Target Restra & Capaian IKP: ' . $year . ' - Rektor';
        $this->year = Year::where("year", $year)->with(["fillTarget", 'capaianRetraUpload.bukti:id,name'])->firstOrFail();
        $this->indicators = Indikator::with(["fillTarget" => function ($query) {
            $query->where('years_id', $this->year->id);
        }, 'capaianRetraUpload.bukti', 'isiCapaian' => function ($q) {
            $q->where("years_id", $this->year->id);
        }])->get();

        $this->fillIsiCapaian = $this->indicators->map(function ($indicator) {
            $fill_target = $indicator->fillTarget->first();
            $fill_target_value = $fill_target ? $fill_target->fill_target : 0;
            return [
                'years_id' => $this->year->id,
                'indikator_id' => $indicator->id,
                'name' => $indicator->name,
                'unit_name' => $indicator->unit->name,
                'faculty_targets' => $indicator->faculty_targets,
                'fill_target' => $fill_target_value,
                'capaianRetraUpload' => $indicator->capaianRetraUpload,
                'isiCapaian' => $indicator->isiCapaian,
            ];
        })->toArray();
    }


    public function file($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;
        $this->selectedFillIsiCapaian = Indikator::with('capaianRetraUpload.bukti')->find($indikatorId);
        if ($this->selectedFillIsiCapaian) {
            $this->bukti_upload_id = $this->selectedFillIsiCapaian->fillTarget()->first()->bukti_upload_id ?? null;
        }
    }
    public function render()
    {
        return view('livewire.pages.rektor.capaian-restra.lihat-capaian')->layout('layouts.app');
    }
}
