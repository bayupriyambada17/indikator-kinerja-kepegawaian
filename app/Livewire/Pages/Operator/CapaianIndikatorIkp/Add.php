<?php

namespace App\Livewire\Pages\Operator\CapaianIndikatorIkp;

use App\Models\CapaianIndikatorIkp;
use App\Models\Satuan;
use Livewire\Component;

class Add extends Component
{
    public $pageTitle = 'Tambah Capaian Indikator';
    public $name = [];
    public $satuan_id = [];
    public $faculty_targets = [];
    public $inputs = [];
    public $i = 1;
    public $nextIndex = 0;

    private function resetFields()
    {
        $this->name = null;
        $this->satuan_id = null;
        $this->faculty_targets = null;
    }

    public function mount()
    {
        $this->name[0] = '';
        $this->satuan_id[0] = '';
        $this->faculty_targets[0] = '';
    }

    public function add()
    {

        $this->inputs[] = count($this->inputs);
        $this->name[] = '';
        $this->satuan_id[] = '';
        $this->faculty_targets[] = '';
    }

    public function remove($i)
    {

        unset($this->inputs[$i]);
        unset($this->name[$i]);
        unset($this->satuan_id[$i]);
        unset($this->faculty_targets[$i]);
    }
    public function store()
    {
        $this->validate(
            [
                'name.0' => 'required',
                'name.*' => 'required',
                'satuan_id.0' => 'required',
                'satuan_id.*' => 'required',
                'faculty_targets.0' => 'required',
                'faculty_targets.*' => 'required',
            ],
            [
                'name.0.required' => 'name field is required',
                'name.*.required' => 'name field is required',
                'satuan_id.0.required' => 'satuan_id field is required',
                'satuan_id.*.required' => 'satuan_id field is required',
                'faculty_targets.0.required' => 'faculty_targets field is required',
                'faculty_targets.*.required' => 'faculty_targets field is required',
            ]
        );


        foreach ($this->name as $key => $value) {
            CapaianIndikatorIkp::create(
                [
                    'name' => $this->name[$key],
                    'satuan_id' => $this->satuan_id[$key],
                    'faculty_targets' => $this->faculty_targets[$key],
                ]
            );
        }

        $this->inputs = [];
        $this->resetFields();
        session()->flash('message', 'Capaian Indikator berhasil ditambahkan.');
        return redirect(route('capaian.indikator'));
    }
    public function render()
    {
        $unitIndicators = Satuan::get();
        return view('livewire.pages.operator.capaian-indikator-ikp.add', [
            'unitIndicators' => $unitIndicators
        ])->layout("layouts.app");
    }
}
