<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_video extends Model
{
    use HasFactory;

    public function kategoriVideo()
    {
        return $this->belongsTo(Tb_kategori_video::class, 'id_kategori_video');
    }
}
