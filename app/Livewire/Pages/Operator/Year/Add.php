<?php

namespace App\Livewire\Pages\Operator\Year;

use App\Models\Year;
use Livewire\Component;

class Add extends Component
{
    public $year = '';

    public function store()
    {
        $this->validate([
            'year' => 'required|min:1'
        ]);

        $yearId = Year::where('year', $this->year)->first();
        if ($yearId) {
            return redirect()->back();
            $this->year = '';
        }
        Year::create([
            'year' => $this->year
        ]);

        session()->flash('message', 'Tahun Kinerja sudah ditambahkan!');
        return redirect(route('year'));
    }
    public function render()
    {
        return view('livewire.pages.operator.year.add')->layout("layouts.app");
    }
}
