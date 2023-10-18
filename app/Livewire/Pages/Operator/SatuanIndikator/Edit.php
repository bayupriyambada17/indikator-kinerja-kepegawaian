<?php

namespace App\Livewire\Pages\Operator\SatuanIndikator;

use App\Models\Satuan;
use Livewire\Component;

class Edit extends Component
{
    public $unitId, $name;

    protected $rules = [
        'name' => 'required|min:1',
    ];

    public function mount($unitId)
    {
        $unitId = Satuan::findOrFail($unitId);
        $this->unitId = $unitId->id;
        $this->name = $unitId->name;
    }

    public function updateData()
    {
        $this->validate();

        Satuan::findOrFail($this->unitId)->update([
            'name' => $this->name
        ]);

        session()->flash('message', 'Satuan berhasil di perbaharui.');
        return redirect()->route("satuan.indikator");
    }
    public function render()
    {
        return view('livewire.pages.operator.satuan-indikator.edit')->layout("layouts.app");
    }
}
