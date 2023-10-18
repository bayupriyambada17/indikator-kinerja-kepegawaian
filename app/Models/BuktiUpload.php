<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\IsiTargetCapaianRetraUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuktiUpload extends Model
{
    use HasFactory;
    protected $table = 'bukti_upload';
    protected $guarded = ['id'];

    public function capaianRetraUpload()
    {
        return $this->hasMany(IsiTargetCapaianRetraUpload::class, 'bukti_upload_id', 'id');
    }
}
