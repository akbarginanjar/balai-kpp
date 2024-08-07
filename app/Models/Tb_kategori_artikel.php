<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_kategori_artikel extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nama', 'slug'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function artikel()
    {
        return $this->hasMany(Tb_artikel::class, 'id_kategori_artikel');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($kategoriArtikel) {
            //mengecek apakah penulis masih punya wisata
            if ($kategoriArtikel->artikel->count() > 0) {
                session()->put('warning', 'Data Tidak Bisa Di Hapus Karena Memiliki Artikel');
                return false;
            }
        });
    }

    public function cover()
    {
        if ($this->cover && file_exists(public_path('images/kategori-artikel/' . $this->cover))) {
            return asset('images/kategori-artikel/' . $this->cover);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteGambar()
    {
        if ($this->cover && file_exists(public_path('images/kategori-artikel/' . $this->cover))) {
            return unlink(public_path('images/kategori-artikel/' . $this->cover));
        }
    }
}
