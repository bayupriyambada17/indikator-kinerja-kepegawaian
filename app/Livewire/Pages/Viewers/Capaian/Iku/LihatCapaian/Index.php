<?php

namespace App\Livewire\Pages\Viewers\Capaian\Iku\LihatCapaian;

use App\Models\Year;
use Livewire\Component;
use App\Models\BuktiUpload;
use App\Models\CapaianIndikatorIkp;

class Index extends Component
{
    public $pageTitle = 'Lihat Capaian';
    public $year;
    public $indicators;
    public $fillIsiCapaian;
    public $buktiUploads;

    public function mount($year)
    {
        $this->buktiUploads = BuktiUpload::get();
        $this->pageTitle = 'Target Isi Capaian IKU: ' . $year;
        $this->year = Year::where("year", $year)->with(["fillTarget", 'capaianIkpUpload.bukti:id,name'])->firstOrFail();
        $this->indicators = CapaianIndikatorIkp::with(["unit:id,name", "fillTarget" => function ($query) {
            $query->where('years_id', $this->year->id);
        }, 'capaianIkpUpload', 'isiCapaian' => function ($q) {
            $q->where('years_id', $this->year->id);
        }])->get();

        $this->fillIsiCapaian = $this->indicators->map(function ($indicator) {
            $fill_target = $indicator->fillTarget->first();
            $fill_target_value = $fill_target ? $fill_target->fill_target : 0;
            return [
                'years_id' => $this->year->id,
                'indikator_id' => $indicator->id,
                'name' => $indicator->name,
                'unit_name' => $indicator->unit->name,
                'faculty_targets' => $indicator->faculty_targets,
                'fill_target' => $fill_target_value,
                'capaianIkpUpload' => $indicator->capaianIkpUpload,
                'isiCapaian' => $indicator->isiCapaian
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.pages.viewers.capaian.iku.lihat-capaian.index', [
            'buktiUploads' => $this->buktiUploads
        ])->layout('layouts.app');
    }
}
