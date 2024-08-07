<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_konten extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function menu()
    {
        return $this->hasMany(Tb_menu::class, 'id_konten');
    }
    public function submenu()
    {
        return $this->hasMany(Tb_submenu::class, 'id_konten');
    }
    public function halaman()
    {
        return $this->belongsTo(Tb_halaman::class, 'id_halaman');
    }
    public function artikel()
    {
        return $this->belongsTo(Tb_artikel::class, 'id_artikel');
    }
    public function kategoriArtikel()
    {
        return $this->belongsTo(Tb_kategori_artikel::class, 'id_kategori_artikel');
    }
    public function kegiatan()
    {
        return $this->belongsTo(Tb_kegiatan::class, 'id_kegiatan');
    }
    public function link()
    {
        return $this->belongsTo(Tb_link::class, 'id_link');
    }
}