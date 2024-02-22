<?php

namespace App\Livewire\Pages\Viewers\Capaian\Iku;

use App\Models\Year;
use Livewire\Component;

class Index extends Component
{
    public $pageTitle = 'Capaian & Target IKU';
    public function render()
    {
        $years = Year::withCount('fillTargetIku')->get();
        return view('livewire.pages.viewers.capaian.iku.index', [
            'years' => $years
        ])->layout("layouts.app");
    }
}
