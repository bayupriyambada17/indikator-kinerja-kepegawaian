<?php

namespace App\Livewire\Pages\Viewers\Capaian\Restra\LihatCapaian;

use App\Models\Year;
use Livewire\Component;
use App\Models\Indikator;
use App\Http\Resources\IndikatorResource;

class Index extends Component
{
    public $pageTitle;
    public $year;
    public $indicators;
    public $fillIsiCapaian;

    public $selectedYearsId;
    public $selectedIndikatorId;
    public $selectedYear;
    public $selectedFillIsiCapaian;
    public $bukti_upload_id;



    public function mount($year)
    {
        $this->pageTitle = 'Target Restra & Capaian IKU: ' . $year;
        // $this->year = Year::where("year", $year)->with(["fillTarget", 'capaianRetraUpload.bukti:id,name'])->firstOrFail();
        // $this->indicators = Indikator::with(["unit:id,name", "fillTarget" => function ($query) {
        //     $query->where('years_id', $this->year->id);
        // }, 'capaianRetraUpload.bukti', 'isiCapaian' => function ($q) {
        //     $q->where("years_id", $this->year->id);
        // }])->get();

        // $this->fillIsiCapaian = $this->indicators->map(function ($indicator) {
        //     $fill_target = $indicator->fillTarget->first();
        //     $fill_target_value = $fill_target ? $fill_target->fill_target : 0;
        //     return [
        //         'years_id' => $this->year->id,
        //         'indikator_id' => $indicator->id,
        //         'name' => $indicator->name,
        //         'unit_name' => $indicator->unit->name,
        //         'faculty_targets' => $indicator->faculty_targets,
        //         'fill_target' => $fill_target_value,
        //         'capaianRetraUpload' => $indicator->capaianRetraUpload,
        //         'isiCapaian' => $indicator->isiCapaian
        //     ];
        // })->toArray();
        // dd($this->fillIsiCapaian);

        $this->year = Year::where("year", $year)->with(["fillTarget", 'capaianRetraUpload.bukti'])->firstOrFail();
        $this->indicators = Indikator::with(["unit", "fillTarget" => function ($query) {
            $query->where('years_id', $this->year->id);
        }, 'capaianRetraUpload.bukti', 'isiCapaian' => function ($q) {
            $q->where("years_id", $this->year->id);
        }])->get();

        $this->fillIsiCapaian = IndikatorResource::collection($this->indicators)->map(function ($indicator) {
            return [
                'years_id' => $this->year->id,
                'indikator_id' => $indicator->id,
                'name' => $indicator->name,
                'unit_name' => $indicator->unit->name,
                'faculty_targets' => $indicator->faculty_targets ?? 0,
                'fill_target' => $indicator->fill_target ?? 0,
                'capaianRetraUpload' => $indicator->capaianRetraUpload,
                'isiCapaian' => ['comment' => $indicator->isiCapaian->comment] ?? []
            ];
        })->toArray();

        // dd($this->fillIsiCapaian);


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
    public function render()
    {
        return view('livewire.pages.viewers.capaian.restra.lihat-capaian.index')->layout("layouts.app");
    }
}
