<?php

namespace App\Models;

use App\Models\IsiTarget;
use Illuminate\Database\Eloquent\Model;
use App\Models\IsiTargetCapaianRetraUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Year extends Model
{
    use HasFactory;

    protected $table = 'years';
    protected $guarded = ['id'];

    public function fillTarget()
    {
        return $this->hasMany(IsiTarget::class, 'years_id', 'id');
    }

    public function fillTargetIku()
    {
        return $this->hasMany(IsiTargetIkp::class, 'years_id', 'id');
    }

    public function capaianRetraUpload()
    {
        return $this->hasMany(IsiTargetCapaianRetraUpload::class, 'years_id', 'id');
    }
    public function capaianIkpUpload()
    {
        return $this->hasMany(IsiTargetCapaianIkpUpload::class, 'years_id', 'id');
    }
}
