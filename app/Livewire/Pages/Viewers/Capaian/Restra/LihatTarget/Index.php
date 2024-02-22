<?php

namespace App\Livewire\Pages\Viewers\Capaian\Restra\LihatTarget;

use App\Models\Year;
use Livewire\Component;
use App\Models\Indikator;

class Index extends Component
{
    public $pageTitle = 'Lihat Target';
    public $year;
    public $indicators;
    public $fillTargets;
    public function mount($year)
    {
        $this->pageTitle = 'Isi Target: ' . $year;
        $this->year = Year::where("year", $year)->with("fillTarget")->firstOrFail();
        $this->indicators = Indikator::with(["unit:id,name", "fillTarget" => function ($query) {
            $query->where('years_id', $this->year->id);
        }])->get();

        $this->fillTargets = $this->indicators->map(function ($indicator) {
            $fill_target = $indicator->fillTarget->first();
            $fill_target_value = $fill_target ? $fill_target->fill_target : 0;

            return [
                'years_id' => $this->year->id,
                'indikator_id' => $indicator->id,
                'name' => $indicator->name,
                'unit_name' => $indicator->unit->name,
                'faculty_targets' => $indicator->faculty_targets,
                'fill_target' => $fill_target_value,
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.pages.viewers.capaian.restra.lihat-target.index')->layout("layouts.app");
    }
}
