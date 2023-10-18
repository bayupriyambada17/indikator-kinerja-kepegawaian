<?php

namespace App\Models;

use App\Models\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IsiTargetCapaianRetraUpload extends Model
{
    use HasFactory;

    protected $table = 'isi_target_capaian_retra_uploads';
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
