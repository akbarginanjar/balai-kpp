<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_kategori_galeri extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nama', 'slug'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function galeri()
    {
        return $this->hasMany(Tb_galeri::class, 'id_kategori_galeri');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($kategorigaleri) {
            //mengecek apakah penulis masih punya wisata
            if ($kategorigaleri->galeri->count() > 0) {
                session()->put('warning', 'Data Tidak Bisa Di Hapus Karena Memiliki galeri');
                return false;
            }
        });
    }

    public function cover()
    {
        if ($this->cover && file_exists(public_path('images/kategoriGaleri/' . $this->cover))) {
            return asset('images/kategoriGaleri/' . $this->cover);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteCover()
    {
        if ($this->cover && file_exists(public_path('images/kategoriGaleri/' . $this->cover))) {
            return unlink(public_path('images/kategoriGaleri/' . $this->cover));
        }
    }
}
