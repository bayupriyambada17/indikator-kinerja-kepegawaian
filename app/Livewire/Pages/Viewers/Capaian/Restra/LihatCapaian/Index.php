<?php

namespace App\Livewire\Pages\Viewers\Capaian\Restra\LihatCapaian;

use App\Models\Year;
use Livewire\Component;
use App\Models\Indikator;
use App\Models\BuktiUpload;

class Index extends Component
{
    public $pageTitle;
    public $year;
    public $indicators;
    public $fillIsiCapaian;

    public function mount($year)
    {
        $this->pageTitle = 'Target Restra & Capaian IKU: ' . $year;
        $this->year = Year::where("year", $year)->with(["fillTarget", 'capaianRetraUpload.bukti:id,name'])->firstOrFail();
        $this->indicators = Indikator::with(["unit:id,name", "fillTarget" => function ($query) {
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
                'isiCapaian' => $indicator->isiCapaian
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.pages.viewers.capaian.restra.lihat-capaian.index')->layout("layouts.app");
    }
}
