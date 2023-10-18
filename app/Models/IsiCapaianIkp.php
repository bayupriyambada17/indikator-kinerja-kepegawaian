<?php

namespace App\Models;

use App\Models\Year;
use App\Models\CapaianIndikatorIkp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IsiCapaianIkp extends Model
{
    use HasFactory;
    protected $table = 'isi_capaian_ikp';
    protected $guarded = ['id'];

    public function years()
    {
        return $this->hasMany(Year::class, 'id', 'years_id');
    }
    public function capaianIndikator()
    {
        return $this->belongsTo(CapaianIndikatorIkp::class, 'capaian_indikator_ikp_id', 'id');
    }
}
