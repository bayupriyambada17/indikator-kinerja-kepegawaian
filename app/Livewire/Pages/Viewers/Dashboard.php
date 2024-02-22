<?php

namespace App\Livewire\Pages\Viewers;

use Livewire\Component;

class Dashboard extends Component
{
    public $pageTitle = 'Dashboard';

    public function render()
    {
        return view('livewire.pages.viewers.dashboard')->layout("layouts.app");
    }
}
