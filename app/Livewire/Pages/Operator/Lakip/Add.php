<?php

namespace App\Livewire\Pages\Operator\Lakip;

use App\Models\Lakip;
use App\Models\Year;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    public $pageTitle = 'LAKIP';
    public $years_id, $pdf, $docs;
    use WithFileUploads;


    public function store()
    {
        $this->validate([
            'years_id' => 'required',
            'pdf' => 'required|mimes:pdf|max:5024', // 5MB Max
            'docs' => 'required|mimes:docx,doc|max:5024', // 5MB Max
        ]);

        $findYearsId = Lakip::where('years_id', $this->years_id)->first();
        if ($findYearsId) {
            dd("data ini telah di simpan pada LAKIP");
        }

        Lakip::create([
            'years_id' => $this->years_id,
            'pdf' => $this->pdf->store('pdf', 'public'),
            'docs' => $this->docs->store('docs', 'public'),
            'upload_times' => now()
        ]);

        return redirect(route("lakip"));
    }
    public function render()
    {
        $years = Year::get();

        return view('livewire.pages.operator.lakip.add', [
            'years' => $years
        ])->layout('layouts.app');
    }
}
