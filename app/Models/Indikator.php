<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $table = 'indikator';
    protected $guarded = ['id'];

    public function unit()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }

    public function fillTarget()
    {
        return $this->hasMany(IsiTarget::class, 'indikator_id', 'id');
    }

    public function capaianRetraUpload()
    {
        return $this->hasMany(IsiTargetCapaianRetraUpload::class, 'indikator_id', 'id');
    }

    public function isiCapaian()
    {
        return $this->belongsTo(IsiCapaianRestra::class, 'id', 'indikator_id');
    }
}
