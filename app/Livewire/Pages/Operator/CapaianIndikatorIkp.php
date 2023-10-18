<?php

namespace App\Livewire\Pages\Operator;

use App\Models\CapaianIndikatorIkp as ModelsCapaianIndikatorIkp;
use Livewire\Component;

class CapaianIndikatorIkp extends Component
{
    public $pageTitle = 'Capaian Indikator IKP';
    public function render()
    {
        $capaianIndikator = ModelsCapaianIndikatorIkp::with('unit')->get();
        return view('livewire.pages.operator.capaian-indikator-ikp', [
            'capaianIndikator' => $capaianIndikator
        ])->layout("layouts.app");
    }

    public function destroy($capaianIndikatorId)
    {
        $capaianIndikatorId = ModelsCapaianIndikatorIkp::findOrFail($capaianIndikatorId);
        $capaianIndikatorId->delete();
        session()->flash('message', $capaianIndikatorId->name . ' berhasil dihapus!');
        return redirect(route('operator.indikator'));
    }
}
