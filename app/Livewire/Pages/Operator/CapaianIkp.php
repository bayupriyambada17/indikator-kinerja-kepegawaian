<?php

namespace App\Livewire\Pages\Operator;

use App\Models\Year;
use Livewire\Component;

class CapaianIkp extends Component
{
    public $pageTitle = 'Capaian & Target IKP';
    public function render()
    {
        $years = Year::withCount('fillTargetIku')->get();
        return view('livewire.pages.operator.capaian-ikp', [
            'years' => $years
        ])->layout('layouts.app');
    }
}
