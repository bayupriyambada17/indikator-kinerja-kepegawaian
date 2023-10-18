<?php

namespace App\Livewire\Pages\Operator;

use App\Models\Lakip as ModelsLakip;
use Livewire\Component;

class Lakip extends Component
{
    public $pageTitle = 'Lakip';

    public function render()
    {
        $lakips = ModelsLakip::with('years:id,year')->get();
        return view(
            'livewire.pages.operator.lakip',
            [
                'lakips' => $lakips
            ]
        )->layout("layouts.app");
    }

    public function destroy($lakipId)
    {
        $lakipId = ModelsLakip::findOrFail($lakipId);
        if (file_exists(public_path('storage/' . $lakipId->pdf))) {
            unlink(public_path('storage/' . $lakipId->pdf));
        }

        // menghapus dokumen
        if (file_exists(public_path('storage/' . $lakipId->docs))) {
            unlink(public_path('storage/' . $lakipId->docs));
        }
        $lakipId->delete();
        return redirect()->back();
    }
}
