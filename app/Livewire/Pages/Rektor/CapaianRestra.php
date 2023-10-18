<?php

namespace App\Livewire\Pages\Rektor;

use App\Models\Year;
use Livewire\Component;

class CapaianRestra extends Component
{
    public $pageTitle = 'Capaian & Target Restra - Rektor';
    public function render()
    {
        $years = Year::withCount('fillTarget')->get();
        return view('livewire.pages.rektor.capaian-restra', [
            'years' => $years
        ])->layout('layouts.app');
    }
}
