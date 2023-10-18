<?php

namespace App\Models;

use App\Models\Year;
use App\Models\BuktiUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IsiTargetCapaianIkpUpload extends Model
{
    use HasFactory;
    protected $table = 'isi_target_capaian_ikp_upload';
    protected $guarded = ['id'];

    public function years()
    {
        return $this->belongsTo(Year::class, 'id', 'years_id');
    }

    public function bukti()
    {
        return $this->belongsTo(BuktiUpload::class, 'bukti_upload_id', 'id');
    }
}
