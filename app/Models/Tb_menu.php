<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function konten()
    {
        return $this->belongsTo(Tb_konten::class, 'id_konten');
    }

    public function submenu()
    {
        return $this->hasMany(Tb_submenu::class, 'id_menu');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($menu) {
            //mengecek apakah penulis masih punya wisata
            if ($menu->submenu->count() > 0) {
                session()->put('warning', 'Data Tidak Bisa Di Hapus Karena Memiliki SubMenu');
                return false;
            }
        });
    }
}
