<?php

namespace App\Livewire\Pages\Operator;

use App\Models\Year as Years;
use Livewire\Component;

class Year extends Component
{
    public $pageTitle = 'Tahun Kinerja';
    public function render()
    {
        $years = Years::get();
        return view('livewire.pages.operator.year', [
            'years' => $years
        ])->layout("layouts.app");
    }

    public function destroy($yearId)
    {
        $yearId = Years::findOrFail($yearId);
        $yearId->delete();
        session()->flash('message', 'Tahun Kinerja berhasil dihapus!');
        return redirect(route('operator.year'));
    }
}
