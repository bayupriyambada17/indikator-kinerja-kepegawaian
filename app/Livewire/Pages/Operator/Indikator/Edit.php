<?php

namespace App\Livewire\Pages\Operator\Indikator;

use App\Models\Satuan;
use Livewire\Component;
use App\Models\Indikator;

class Edit extends Component
{
    public $indicatorId, $name, $satuan_id, $faculty_targets;

    protected $rules = [
        'name' => 'required|min:1',
        'satuan_id' => 'required',
        'faculty_targets' => 'required',
    ];

    public function mount($indicatorId)
    {
        $indicatorId = Indikator::findOrFail($indicatorId);
        $this->indicatorId = $indicatorId->id;
        $this->name = $indicatorId->name;
        $this->satuan_id = $indicatorId->satuan_id;
        $this->faculty_targets = $indicatorId->faculty_targets;
    }

    public function updateData()
    {
        $this->validate();

        Indikator::findOrFail($this->indicatorId)->update([
            'name' => $this->name,
            'satuan_id' => $this->satuan_id,
            'faculty_targets' => $this->faculty_targets,
        ]);

        session()->flash('message', 'Indikator berhasil di perbaharui.');
        return redirect()->route("indikator");
    }
    public function render()
    {
        $unitIndicators = Satuan::get();
        return view(
            'livewire.pages.operator.indikator.edit',
            [
                'unitIndicators' => $unitIndicators
            ]
        )->layout("layouts.app");
    }
}
