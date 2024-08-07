<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_kategori_kegiatan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nama', 'slug'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function kegiatan()
    {
        return $this->hasMany(Tb_kegiatan::class, 'id_kategori_kegiatan');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($kategoriKegiatan) {
            //mengecek apakah penulis masih punya wisata
            if ($kategoriKegiatan->kegiatan->count() > 0) {
                session()->put('warning', 'Data Tidak Bisa Di Hapus Karena Memiliki Kegiatan');
                return false;
            }
        });
    }
}
