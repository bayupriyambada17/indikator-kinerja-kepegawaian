<?php

namespace App\Livewire\Pages\Operator\TargetRestra;

use App\Models\Year;
use Livewire\Component;
use App\Models\Indikator;
use App\Models\BuktiUpload;
use App\Models\IsiCapaianRestra;
use Livewire\WithFileUploads;
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

    use WithFileUploads;

    public function resetFieldsForm()
    {
        $this->bukti_upload_id = null;
        $this->file_upload = null;
    }

    public function mount($year)
    {
        $this->buktiUploads = BuktiUpload::get();
        $this->pageTitle = 'Target Restra & Capaian IKP: ' . $year;
        $this->year = Year::where("year", $year)->with(["fillTarget", 'capaianRetraUpload.bukti:id,name'])->firstOrFail();
        $this->indicators = Indikator::with(["unit:id,name", "fillTarget" => function ($query) {
            $query->where('years_id', $this->year->id);
        }, 'capaianRetraUpload.bukti', 'isiCapaian' => function ($q) {
            $q->where("years_id", $this->year->id);
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
                'capaianRetraUpload' => $indicator->capaianRetraUpload,
                'isiCapaian' => $indicator->isiCapaian
            ];
        })->toArray();
    }

    public function prepareFindUpload($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;
        $this->selectedFillIsiCapaian = Indikator::with('capaianRetraUpload.bukti')->find($indikatorId);

        if ($this->selectedFillIsiCapaian) {
            $this->bukti_upload_id = $this->selectedFillIsiCapaian->fillTarget()->first()->bukti_upload_id;
        }
    }

    public function file($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;
        $this->selectedFillIsiCapaian = Indikator::with('capaianRetraUpload.bukti')->find($indikatorId);
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

        IsiTargetCapaianRetraUpload::create([
            'years_id' => $this->selectedYearsId,
            'indikator_id' => $this->selectedIndikatorId,
            'bukti_upload_id' => $this->bukti_upload_id,
            'file_upload' => $this->file_upload->store('bukti', 'public')
        ]);

        $this->resetFieldsForm();
        $indicator = Indikator::find($this->selectedIndikatorId);
        $indicatorName = $indicator ? $indicator->name : 'Unknown Indicator';

        session()->flash('message', 'Bukti upload berhasil dari indikator: ' . $indicatorName);
        return redirect()->route('capaian.restra.isi-capaian', $this->year->year);
    }

    public function prepareComment($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;

        $this->comment = IsiCapaianRestra::where('years_id', $yearsId)->where('indikator_id', $indikatorId)
            ->select('id', 'years_id', 'indikator_id', 'comment')
            ->first();
    }

    public function createComment()
    {
        $this->validate([
            'comment' => 'required'
        ]);
        IsiCapaianRestra::updateOrCreate(
            ['years_id' => $this->selectedYearsId, 'indikator_id' => $this->selectedIndikatorId],
            ['comment' => $this->comment]
        );

        $indicator = Indikator::find($this->selectedIndikatorId);
        $indicatorName = $indicator ? $indicator->name : 'Unknown Indicator';
        session()->flash('message', 'Bukti upload berhasil dari indikator: ' . $indicatorName);
        return redirect()->route('capaian.restra.isi-capaian', $this->year->year);
    }
    public function editComment()
    {
        $this->comment = '';
    }

    public function validation($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;
        $isValid = IsiCapaianRestra::with('indicators:id,name')
            ->find($yearsId)
            ->updateOrcreate([
                'years_id' => $this->selectedYearsId,
                'indikator_id' => $this->selectedIndikatorId,
            ], [
                'isValid' => 1
            ]);
        session()->flash('message', 'Berhasil Validasi: ' . $isValid->indicators->name);
        return redirect(route('capaian.restra.isi-capaian', $this->year->year));
    }
    public function render()
    {
        return view('livewire.pages.operator.target-restra.isi-capaian')->layout("layouts.app");
    }

    public function destroyUpload($buktiUploadId)
    {
        $buktiUploadId = IsiTargetCapaianRetraUpload::findOrFail($buktiUploadId);
        if (file_exists(public_path('storage/' . $buktiUploadId->file_upload))) {
            unlink(public_path('storage/' . $buktiUploadId->file_upload));
        }
        $buktiUploadId->delete();
        session()->flash('message', 'Berhasil menghapus data ini.');
        return redirect()->route("capaian.restra.isi-capaian", $this->year->year);
    }
}
