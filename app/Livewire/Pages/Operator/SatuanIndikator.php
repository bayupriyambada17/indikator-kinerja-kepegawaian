<?php

namespace App\Livewire\Pages\Operator;

use App\Models\CapaianIndikatorIkp;
use App\Models\Satuan;
use Livewire\Component;
use App\Models\Indikator;

class SatuanIndikator extends Component
{
    public $pageTitle = 'Satuan Indikator';
    public function render()
    {
        $unitIndicators = Satuan::get();
        return view('livewire.pages.operator.satuan-indikator', [
            'unitIndicators' => $unitIndicators
        ])->layout("layouts.app");
    }

    public function destroy($unitId)
    {
        $unitId = Satuan::findOrFail($unitId);
        $indikatorId = Indikator::where("satuan_id", $unitId->id)->first();
        $indikatorIkuId = CapaianIndikatorIkp::where("satuan_id", $unitId->id)->first();
        if ($indikatorId) {
            session()->flash('message', $unitId->name . ' memiliki data relasi, tidak dapat dihapus!');
        } elseif ($indikatorIkuId) {
            session()->flash('message', $unitId->name . ' memiliki data relasi, tidak dapat dihapus!');
        } else {
            $unitId->delete();
            session()->flash('message', $unitId->name . ' sudah dihapus!');
            return redirect()->back();
        }
    }
}
