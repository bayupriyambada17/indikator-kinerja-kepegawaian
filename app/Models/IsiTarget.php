<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiTarget extends Model
{
    use HasFactory;

    protected $table = 'isi_target';
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
