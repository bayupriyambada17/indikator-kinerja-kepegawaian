<?php

namespace App\Livewire\Pages\Operator\TargetRestra;

use App\Models\BuktiUpload;
use App\Models\Indikator;
use App\Models\IsiTarget as ModelsIsiTarget;
use App\Models\Year;
use Livewire\Component;

class IsiTarget extends Component
{
    public $fill_target = [];
    public $year;
    public $indicators;
    public $fillTargets;
    public $pageTitle;

    public function mount($year)
    {

        $this->pageTitle = 'Isi Target: ' . $year;
        $this->year = Year::where("year", $year)->with("fillTarget")->firstOrFail();
        $this->indicators = Indikator::with(["unit:id,name", "fillTarget" => function ($query) {
            $query->where('years_id', $this->year->id);
        }])->get();

        $this->fillTargets = $this->indicators->map(function ($indicator) {
            $fill_target = $indicator->fillTarget->first(); // Ambil fill target pertama
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
    public function saveData()
    {

        foreach ($this->fillTargets as $key => $fill) {
            $isiTarget = ModelsIsiTarget::updateOrInsert(
                ['years_id' => $this->year->id, 'indikator_id' => $fill['indikator_id']],
                ['fill_target' => $fill['fill_target'], 'created_at' => now(), 'updated_at' => now()],
            );
        }
        session()->flash('message', 'Isi target berhasil disimpan.');
        return redirect()->route("capaian.restra.isi-target", $this->year->year);
    }
    public function render()
    {
        return view(
            'livewire.pages.operator.target-restra.isi-target',
        )->layout("layouts.app");
    }
}
