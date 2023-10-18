<?php

namespace App\Livewire\Pages\Operator\Year;

use App\Models\Year;
use Livewire\Component;

class Edit extends Component
{
    public $yearId, $year;

    public function mount($yearId)
    {
        $yearId = Year::findOrFail($yearId);
        $this->yearId = $yearId->id;
        $this->year = $yearId->year;
    }

    public function updateData()
    {
        $this->validate([
            'year' => 'required|min:1',
        ]);

        $findId = Year::where('year', $this->year)->first();
        if ($findId) {
            return redirect()->back();
        }

        Year::findOrFail($this->yearId)->update([
            'year' => $this->year
        ]);

        session()->flash('message', 'Tahun Kinerja berhasil di perbaharui!');
        return redirect(route('year'));
    }
    public function render()
    {
        return view('livewire.pages.operator.year.edit')->layout('layouts.app');
    }
}
