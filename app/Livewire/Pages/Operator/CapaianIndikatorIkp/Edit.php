<?php

namespace App\Livewire\Pages\Operator\CapaianIndikatorIkp;

use App\Models\Satuan;
use Livewire\Component;
use App\Models\CapaianIndikatorIkp;

class Edit extends Component
{
    public $capaianIndicatorId, $name, $satuan_id, $faculty_targets;

    protected $rules = [
        'name' => 'required|min:1',
        'satuan_id' => 'required',
        'faculty_targets' => 'required',
    ];

    public function mount($capaianIndicatorId)
    {
        $capaianIndicatorId = CapaianIndikatorIkp::findOrFail($capaianIndicatorId);
        $this->capaianIndicatorId = $capaianIndicatorId->id;
        $this->name = $capaianIndicatorId->name;
        $this->satuan_id = $capaianIndicatorId->satuan_id;
        $this->faculty_targets = $capaianIndicatorId->faculty_targets;
    }

    public function updateData()
    {
        $this->validate();

        CapaianIndikatorIkp::findOrFail($this->capaianIndicatorId)->update([
            'name' => $this->name,
            'satuan_id' => $this->satuan_id,
            'faculty_targets' => $this->faculty_targets,
        ]);

        session()->flash('message', 'Capaian indikator berhasil di perbaharui.');
        return redirect()->route("capaian.indikator");
    }
    public function render()
    {
        $unitIndicators = Satuan::get();
        return view('livewire.pages.operator.capaian-indikator-ikp.edit', [
            'unitIndicators' => $unitIndicators,
        ])->layout('layouts.app');
    }
}
