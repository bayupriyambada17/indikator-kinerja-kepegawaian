<?php

namespace App\Livewire\Pages\Operator\TargetRestra;

use App\Models\Year;
use Livewire\Component;
use App\Models\Indikator;
use App\Models\BuktiUpload;
use Livewire\WithFileUploads;
use App\Models\IsiCapaianRestra;
use Illuminate\Support\Facades\Storage;
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
    public $judul_file;

    public $selectedFillIsiCapaian = null;
    public $selectedYearsId;
    public $selectedIndikatorId;

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
        $this->pageTitle = 'Target Restra & Capaian IKU: ' . $year;
        $this->year = Year::where("year", $year)->with(["fillTarget", 'capaianRetraUpload.bukti' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->firstOrFail();
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
            $this->bukti_upload_id = $this->selectedFillIsiCapaian->fillTarget()->first()->bukti_upload_id ?? null;
        }
    }

    public function file($yearsId, $indikatorId)
    {
        $this->selectedYearsId = $yearsId;
        $this->selectedIndikatorId = $indikatorId;
        $this->selectedFillIsiCapaian = Indikator::with('capaianRetraUpload.bukti', function ($q) {
            $q->orderBy('created_at', 'desc');
        })->find($indikatorId);
        if ($this->selectedFillIsiCapaian) {
            $this->bukti_upload_id = $this->selectedFillIsiCapaian->fillTarget()->first()->bukti_upload_id ?? null;
        }
    }

    public function createUpload()
    {
        $this->validate(['bukti_upload_id' => 'required', 'file_upload' => 'required|max:2048|mimes:pdf',
            'judul_file' => 'required|min:1'
        ], [
            'bukti_upload_id.required' => 'Bukti upload harus dipilih',
            'file_upload.required' => 'File upload harus dipilih',
            'file_upload.max' => 'File upload maksimal 2 MB',
            'file_upload.mimes' => 'File upload harus PDF',
            'judul_file.required' => 'Judul file harus diisi',
        ]);

        $file_name = $this->file_upload->hashName();
        Storage::disk('public')->putFileAs('bukti_upload_restra', $this->file_upload, $file_name);

        IsiTargetCapaianRetraUpload::create([
            'years_id' => $this->selectedYearsId,
            'indikator_id' => $this->selectedIndikatorId,
            'bukti_upload_id' => $this->bukti_upload_id,
            'judul_file' => $this->judul_file,
            'file_upload' => $file_name
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
        if (file_exists(public_path('bukti_upload_restra/' . $buktiUploadId->file_upload))) {
            unlink(public_path('bukti_upload_restra/' . $buktiUploadId->file_upload));
        }
        $buktiUploadId->delete();
        session()->flash('message', 'Berhasil menghapus data ini.');
        return redirect()->route("capaian.restra.isi-capaian", $this->year->year);
    }
}
