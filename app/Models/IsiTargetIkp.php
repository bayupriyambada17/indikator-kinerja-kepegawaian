<?php

namespace App\Models;

use App\Models\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IsiTargetIkp extends Model
{
    use HasFactory;

    protected $table = 'isi_target_ikp';
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
