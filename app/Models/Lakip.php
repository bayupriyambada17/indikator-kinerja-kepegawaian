<?php

namespace App\Models;

use App\Models\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lakip extends Model
{
    use HasFactory;

    protected $table = 'lakip';
    protected $guarded = ['id'];

    public function years()
    {
        return $this->belongsTo(Year::class);
    }
}
