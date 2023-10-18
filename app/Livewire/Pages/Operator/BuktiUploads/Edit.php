<?php

namespace App\Livewire\Pages\Operator\BuktiUploads;

use App\Models\BuktiUpload;
use Livewire\Component;

class Edit extends Component
{
    public $buktiUploadId, $name;
    public $pageTitle;

    public function mount($buktiUploadId)
    {
        $buktiUploadId = BuktiUpload::findOrFail($buktiUploadId);
        $this->pageTitle = 'Bukti Edit: ' . $buktiUploadId->name;
        $this->buktiUploadId = $buktiUploadId->id;
        $this->name = $buktiUploadId->name;
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required|min:1',
        ]);

        $findId = BuktiUpload::where('name', $this->name)->first();
        if ($findId) {
            return redirect()->back();
        }

        BuktiUpload::findOrFail($this->buktiUploadId)->update([
            'name' => $this->name
        ]);

        session()->flash('message', 'Bukti Upload berhasil di perbaharui!');
        return redirect(route('bukti-upload'));
    }
    public function render()
    {
        return view('livewire.pages.operator.bukti-uploads.edit')->layout('layouts.app');
    }
}
