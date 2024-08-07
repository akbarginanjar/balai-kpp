<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_kategori_ebook extends Model
{
    use HasFactory;
    
    protected $fillable = ['nama', 'slug'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    protected $table = 'tb_kategori_ebook';
    
    public function ebook()
    {
        return $this->hasMany(Tb_ebook::class, 'id_kategori_ebook');
    }
    
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($kategoriEbook) {
            if ($kategoriEbook->ebook->count() > 0) {
                session()->put('warning', 'Data Tidak Bisa Di Hapus Karena Memiliki Artikel');
                return false;
            }
        });
    }
}