<?php

namespace App\Livewire\Pages\Operator;

use App\Models\Indikator as IndikatorModels;
use App\Models\IsiTarget;
use Livewire\Component;

class Indikator extends Component
{
    public $pageTitle = 'Indikator';
    public function render()
    {
        $indicators = IndikatorModels::with('unit')->get();
        return view('livewire.pages.operator.indikator', [
            'indicators' => $indicators
        ])->layout("layouts.app");
    }

    public function destroy($indicatorId)
    {
        $indicatorId = IndikatorModels::findOrFail($indicatorId);
        if ($indicatorId) {
            IsiTarget::where("indikator_id", $indicatorId->id)->delete();
            $indicatorId->delete();
            session()->flash('message', $indicatorId->name . ' sudah dihapus!');
        } else {
            session()->flash('message', 'Indikator tidak ditemukan.');
        }
        return redirect(route('indikator'));
    }
}
