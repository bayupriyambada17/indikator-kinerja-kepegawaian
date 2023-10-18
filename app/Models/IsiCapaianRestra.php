<?php

namespace App\Models;

use App\Models\Year;
use App\Models\Indikator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IsiCapaianRestra extends Model
{
    use HasFactory;
    protected $table = 'isi_capaian_restra';
    protected $guarded = ['id'];

    public function years()
    {
        return $this->hasMany(Year::class, 'id', 'years_id');
    }
    public function indicators()
    {
        return $this->belongsTo(Indikator::class, 'indikator_id', 'id');
    }
}
