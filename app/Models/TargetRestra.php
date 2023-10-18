<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetRestra extends Model
{
    use HasFactory;

    protected $table = 'target_restra';
    protected $guarded = ['id'];
}
