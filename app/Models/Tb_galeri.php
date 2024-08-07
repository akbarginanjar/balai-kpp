<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_galeri extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function kategori_galeri()
    {
        return $this->belongsTo(Tb_kategori_galeri::class, 'id_kategori_galeri');
    }

    public function gambar()
    {
        if ($this->gambar && file_exists(public_path('images/galeri/' . $this->gambar))) {
            return asset('images/galeri/' . $this->gambar);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteGambar()
    {
        if ($this->gambar && file_exists(public_path('images/galeri/' . $this->gambar))) {
            return unlink(public_path('images/galeri/' . $this->gambar));
        }
    }
}
