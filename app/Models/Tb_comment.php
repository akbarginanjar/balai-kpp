<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function artikel()
    {
        return $this->belongsTo(Tb_artikel::class);
    }
}