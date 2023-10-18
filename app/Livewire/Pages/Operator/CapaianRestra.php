<?php

namespace App\Livewire\Pages\Operator;

use App\Models\Year;
use Livewire\Component;

class CapaianRestra extends Component
{
    public $pageTitle = 'Capaian & Target Restra';
    public function render()
    {
        $years = Year::withCount('fillTarget')->get();
        return view('livewire.pages.operator.capaian-restra', [
            'years' => $years
        ])->layout("layouts.app");
    }
}
