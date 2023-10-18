<?php

namespace App\Models;

use App\Models\Satuan;
use App\Models\IsiTargetIkp;
use Illuminate\Database\Eloquent\Model;
use App\Models\IsiTargetCapaianIkpUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CapaianIndikatorIkp extends Model
{
    use HasFactory;

    protected $table = 'capaian_indikator_ikp';
    protected $guarded = ['id'];

    public function unit()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }

    public function fillTarget()
    {
        return $this->hasMany(IsiTargetIkp::class, 'capaian_indikator_ikp_id', 'id');
    }

    public function capaianIkpUpload()
    {
        return $this->hasMany(IsiTargetCapaianIkpUpload::class, 'capaian_indikator_ikp_id', 'id');
    }
    public function isiCapaian()
    {
        return $this->hasMany(IsiCapaianIkp::class, 'capaian_indikator_ikp_id', 'id');
    }
}
