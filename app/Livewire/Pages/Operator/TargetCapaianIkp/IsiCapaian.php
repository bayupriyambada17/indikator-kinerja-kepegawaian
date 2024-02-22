<?php

namespace App\Livewire\Pages\Operator\TargetCapaianIkp;

use App\Models\Year;
use Livewire\Component;
use App\Models\Indikator;
use App\Models\BuktiUpload;
use Livewire\WithFileUploads;
use App\Models\IsiCapaianRestra;
use App\Models\CapaianIndikatorIkp;
use App\Models\IsiCapaianIkp;
use App\Models\IsiTargetCapaianIkpUpload;
use App\Models\IsiTargetCapaianRetraUpload;

class IsiCapaian extends Component
{
    public $pageTitle;
    public $year;
    public $fillIsiCapaian;
    public $indicators;
    public $buktiUploads;
    public $bukti_upload_id;
    public $file_upload;

    public $selectedFillIsiCapaian = null; // Properti untuk menyimpan data yang akan ditampilkan di modal
    public $selectedYearsId; // Properti untuk menyimpan data yang akan ditampilkan di modal
    public $selectedIndikatorId; // Properti untuk menyimpan data yang akan ditampilkan di modal

    public $fillTargets;
    public $comment;
    public $viewComment;
    public $isValid = [];
    public $percent = [];
    public $fileMaster;

    use WithFileUploads;

    public function resetFieldsForm()
    {
        $this->bukti_upload_id = null;
        $this->file_upload = null;
    }

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

    public function prepareFindUpload($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;
        $this->selectedFillIsiCapaian = CapaianIndikatorIkp::with('capaianIkpUpload.bukti')->find($indikatorId);
        if ($this->selectedFillIsiCapaian) {
            $this->bukti_upload_id = $this->selectedFillIsiCapaian->fillTarget()->first()->bukti_upload_id ?? null;
        }
    }

    public function file($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;
        $this->selectedFillIsiCapaian = CapaianIndikatorIkp::with('capaianIkpUpload.bukti')->find($indikatorId);
        if ($this->selectedFillIsiCapaian) {
            $this->bukti_upload_id = $this->selectedFillIsiCapaian->fillTarget()->first()->bukti_upload_id ?? null;
        }
    }


    public function createUpload()
    {
        $this->validate([
            'bukti_upload_id' => 'required',
            'file_upload' => 'required|max:5024|mimes:png,jpg,docx,doc,pdf,jpeg'
        ]);

        IsiTargetCapaianIkpUpload::create([
            'years_id' => $this->selectedYearsId,
            'capaian_indikator_ikp_id' => $this->selectedIndikatorId,
            'bukti_upload_id' => $this->bukti_upload_id,
            'file_upload' => $this->file_upload->store('bukti_ikp', 'public')
        ]);

        $this->resetFieldsForm();
        $indicator = CapaianIndikatorIkp::find($this->selectedIndikatorId);
        $indicatorName = $indicator ? $indicator->name : 'Unknown Indicator';

        // Flash a success message
        session()->flash('message', 'Bukti upload berhasil dari indikator: ' . $indicatorName);
        return redirect()->route('capaian.ikp.isi-capaian', $this->year->year);
    }

    public function prepareComment($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;

        $this->comment = IsiCapaianIkp::where('years_id', $yearsId)->where('capaian_indikator_ikp_id', $indikatorId)
            ->select('id', 'years_id', 'capaian_indikator_ikp_id', 'comment')
            ->first();
    }

    public function createComment()
    {
        $this->validate([
            'comment' => 'required'
        ]);
        IsiCapaianIkp::updateOrCreate(
            ['years_id' => $this->selectedYearsId, 'capaian_indikator_ikp_id' => $this->selectedIndikatorId],
            ['comment' => $this->comment]
        );

        $indicator = CapaianIndikatorIkp::find($this->selectedIndikatorId);
        $indicatorName = $indicator ? $indicator->name : 'Unknown Indicator';
        session()->flash('message', 'Bukti upload berhasil dari indikator: ' . $indicatorName);
        return redirect()->route('capaian.ikp.isi-capaian', $this->year->year);
    }
    public function editComment()
    {
        $this->comment = '';
    }

    public function validation($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;

        $isValid = IsiCapaianIkp::with('capaianIndikator:id,name')
            ->updateOrcreate([
                'years_id' => $this->selectedYearsId,
                'capaian_indikator_ikp_id' => $this->selectedIndikatorId,
            ], [
                'isValid' => 1
            ]);
        session()->flash('message', 'Berhasil Validasi: ' . $isValid->capaianIndikator->name);
        return redirect(route('capaian.ikp.isi-capaian', $this->year->year));
    }
    public function render()
    {
        return view('livewire.pages.operator.target-capaian-ikp.isi-capaian')->layout('layouts.app');
    }
    public function destroyUpload($buktiUploadId)
    {
        $buktiUploadId = IsiTargetCapaianIkpUpload::findOrFail($buktiUploadId);
        if (file_exists(public_path('storage/' . $buktiUploadId->file_upload))) {
            unlink(public_path('storage/' . $buktiUploadId->file_upload));
        }
        $buktiUploadId->delete();
        session()->flash('message', 'Berhasil menghapus data ini.');
        return redirect()->route("capaian.ikp.isi-capaian", $this->year->year);
    }
}
