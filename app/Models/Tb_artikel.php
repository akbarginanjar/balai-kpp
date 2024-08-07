<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_artikel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id_kategori_artikel', 'judul', 'slug', 'gambar'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function konten()
    {
        return $this->hasMany(Tb_konten::class, 'id_artikel');
    }

    public function kategoriArtikel()
    {
        return $this->belongsTo(Tb_kategori_artikel::class, 'id_kategori_artikel');
    }

    public function kategoriKonten()
    {
        return $this->belongsTo(
            Tb_kategori_konten::class,
            'id_kategori_konten'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function gambar()
    {
        if ($this->gambar && file_exists(public_path('images/artikel/' . $this->gambar))) {
            return asset('images/artikel/' . $this->gambar);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteGambar()
    {
        if ($this->gambar && file_exists(public_path('images/artikel/' . $this->gambar))) {
            return unlink(public_path('images/artikel/' . $this->gambar));
        }
    }
}