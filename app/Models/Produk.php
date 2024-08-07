<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produk';
    protected $fillable = ['nama', 'deskripsi', 'slug', 'cover'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function konten()
    {
        return $this->hasMany(Tb_konten::class, 'id_artikel');
    }

    public function kategoriArtikel()
    {
        return $this->belongsTo(
            Tb_kategori_artikel::class,
            'id_kategori_artikel'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function cover()
    {
        if (
            $this->cover &&
            file_exists(public_path('images/produk/' . $this->cover))
        ) {
            return asset('images/produk/' . $this->cover);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteCover()
    {
        if (
            $this->cover &&
            file_exists(public_path('images/produk/' . $this->cover))
        ) {
            return unlink(public_path('images/produk/' . $this->cover));
        }
    }
}