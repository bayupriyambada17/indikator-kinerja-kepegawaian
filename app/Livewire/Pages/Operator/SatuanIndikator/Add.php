<?php

namespace App\Livewire\Pages\Operator\SatuanIndikator;

use App\Models\Satuan;
use Livewire\Component;

class Add extends Component
{
    public $name = [];
    public $inputs = [];
    public $i = 1;
    public $nextIndex = 0;
    private function resetFields()
    {
        $this->name = null;
    }

    public function mount()
    {
        $this->name[0] = '';
    }

    public function add()
    {
        $this->inputs[] = count($this->inputs);
        $this->name[] = '';
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
        unset($this->name[$i]);
    }
    public function store()
    {
        $validatedDate = $this->validate(
            [
                'name.0' => 'required',
                'name.*' => 'required',
            ],
            [
                'name.0.required' => 'name field is required',
                'name.*.required' => 'name field is required',
            ]
        );


        foreach ($this->name as $key => $value) {
            Satuan::create(['name' => $this->name[$key]]);
        }

        $this->inputs = [];
        $this->resetFields();
        session()->flash('message', 'Satuan berhasil ditambahkan.');
        return redirect(route('satuan.indikator'));
    }
    public function render()
    {
        return view('livewire.pages.operator.satuan-indikator.add')->layout("layouts.app");
    }
}
