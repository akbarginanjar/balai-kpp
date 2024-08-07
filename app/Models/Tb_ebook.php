<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_ebook extends Model
{
    use HasFactory;

    protected $table = 'tb_ebook';

    public function kategoriEbook()
    {
        return $this->belongsTo(Tb_kategori_ebook::class, 'id_kategori_ebook');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function gambar()
    {
        if ($this->gambar && file_exists(public_path('images/ebook/' . $this->gambar))) {
            return asset('images/ebook/' . $this->gambar);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteGambar()
    {
        if ($this->gambar && file_exists(public_path('images/ebook/' . $this->gambar))) {
            return unlink(public_path('images/ebook/' . $this->gambar));
        }
    }
}