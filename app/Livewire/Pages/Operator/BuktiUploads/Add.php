<?php

namespace App\Livewire\Pages\Operator\BuktiUploads;

use App\Models\BuktiUpload;
use Livewire\Component;

class Add extends Component
{
    public $name = '';
    public $pageTitle = 'Tambah Bukti Upload';

    public function store()
    {
        $this->validate([
            'name' => 'required|min:1'
        ]);

        $buktiUploads = BuktiUpload::where('name', $this->name)->first();
        if ($buktiUploads) {
            return redirect()->back();
            $this->name = '';
        }
        BuktiUpload::create([
            'name' => $this->name
        ]);

        session()->flash('message', 'Bukti Upload sudah ditambahkan!');
        return redirect(route('bukti-upload'));
    }
    public function render()
    {
        return view('livewire.pages.operator.bukti-uploads.add')
            ->layout("layouts.app");
    }
}
