<?php

namespace App\Livewire\Pages\Rektor\CapaianIku;

use App\Models\Year;
use Livewire\Component;
use App\Models\CapaianIndikatorIkp;

class LihatTarget extends Component
{
    public $fill_target = [];
    public $year;
    public $indicators;
    public $fillTargets;
    public $pageTitle;

    public function mount($year)
    {
        $this->pageTitle = 'Isi Target Capaian IKU: ' . $year . ' - Rektor';
        $this->year = Year::where("year", $year)->with("fillTarget")->firstOrFail();
        $this->indicators = CapaianIndikatorIkp::with(["unit:id,name", "fillTarget" => function ($query) {
            $query->where('years_id', $this->year->id);
        }])->get();

        $this->fillTargets = $this->indicators->map(function ($indicator) {
            $fill_target = $indicator->fillTarget->first(); // Ambil fill target pertama
            $fill_target_value = $fill_target ? $fill_target->fill_target : 0;

            return [
                'years_id' => $this->year->id,
                'capaian_indikator_ikp_id' => $indicator->id,
                'name' => $indicator->name,
                'unit_name' => $indicator->unit->name,
                'faculty_targets' => $indicator->faculty_targets,
                'fill_target' => $fill_target_value,
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.pages.rektor.capaian-iku.lihat-target')->layout('layouts.app');
    }
}
