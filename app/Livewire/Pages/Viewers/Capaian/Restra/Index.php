<?php

namespace App\Livewire\Pages\Viewers\Capaian\Restra;

use App\Models\Year;
use Livewire\Component;

class Index extends Component
{
    public $pageTitle = 'Capaian & Target Restra';
    public function render()
    {
        $years = Year::withCount('fillTarget')->get();
        return view('livewire.pages.viewers.capaian.restra.index', [
            'years' => $years
        ])->layout("layouts.app");
    }
}
