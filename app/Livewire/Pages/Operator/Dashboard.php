<?php

namespace App\Livewire\Pages\Operator;

use App\Models\IsiTarget;
use App\Models\Year;
use App\Models\Lakip;
use Livewire\Component;

class Dashboard extends Component
{
    public $pageTitle = 'Dashboard';

    public function mount()
    {
        if (!auth()->user()->roles === 2) {
            auth()->logout();
        }
    }
    public function render()
    {

        $lakips = Lakip::with('years:id,year')->get();
        return view('livewire.pages.operator.dashboard', [
            'lakips' => $lakips
        ])->layout("layouts.app");
    }
}
