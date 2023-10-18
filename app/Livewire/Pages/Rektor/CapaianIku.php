<?php

namespace App\Livewire\Pages\Rektor;

use App\Models\Year;
use Livewire\Component;

class CapaianIku extends Component
{
    public $pageTitle = 'Capaian & Target IKU - Rektor';
    public function render()
    {
        $years = Year::withCount('fillTargetIku')->get();
        return view('livewire.pages.rektor.capaian-iku', [
            'years' => $years
        ])->layout('layouts.app');
    }
}
