<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_kategori_video extends Model
{
    use HasFactory;

    public function video()
    {
        return $this->hasMany(Tb_video::class, 'id_kategori_video');
    }
    
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($kategoriVideo) {
            if ($kategoriVideo->video->count() > 0) {
                session()->put('warning', 'Data Tidak Bisa Di Hapus Karena Memiliki Artikel');
                return false;
            }
        });
    }
}
