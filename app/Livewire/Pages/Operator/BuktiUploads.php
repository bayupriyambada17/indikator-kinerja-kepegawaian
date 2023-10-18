<?php

namespace App\Livewire\Pages\Operator;

use App\Models\BuktiUpload;
use Livewire\Component;

class BuktiUploads extends Component
{
    public $pageTitle = 'Bukti Uploads';
    public function render()
    {
        $buktiUploads = BuktiUpload::get();
        return view('livewire.pages.operator.bukti-uploads', [
            'buktiUploads' => $buktiUploads
        ])->layout('layouts.app');
    }
    public function destroy($buktiUploadId)
    {
        $buktiUploadId = BuktiUpload::findOrFail($buktiUploadId);
        $buktiUploadId->delete();
        session()->flash('message', $buktiUploadId->name . ' berhasil dihapus!');
        return redirect(route('operator.year'));
    }
}
