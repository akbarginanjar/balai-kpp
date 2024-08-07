<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_kegiatan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id_kategori_kegiatan', 'judul', 'slug', 'gambar'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function konten()
    {
        return $this->hasMany(Tb_konten::class, 'id_kegiatan');
    }

    public function kategoriKegiatan()
    {
        return $this->belongsTo(Tb_kategori_kegiatan::class, 'id_kategori_kegiatan');
    }

    public function gambar()
    {
        if ($this->gambar && file_exists(public_path('images/kegiatan/' . $this->gambar))) {
            return asset('images/kegiatan/' . $this->gambar);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteGambar()
    {
        if ($this->gambar && file_exists(public_path('images/kegiatan/' . $this->gambar))) {
            return unlink(public_path('images/kegiatan/' . $this->gambar));
        }
    }
}
