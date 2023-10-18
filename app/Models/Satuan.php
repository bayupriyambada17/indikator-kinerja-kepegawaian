<?php

namespace App\Models;

use App\Models\CapaianIndikatorIkp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuan';
    protected $guarded = ['id'];

    public function indicators()
    {
        return $this->belongsTo(Indikator::class);
    }
    public function capaianIndikator()
    {
        return $this->belongsTo(CapaianIndikatorIkp::class);
    }
}
