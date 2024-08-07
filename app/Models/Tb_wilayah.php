<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_wilayah extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nama_wilayah'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($wilayah) {
            if ($wilayah->pengguna->count() > 0) {
                session()->put('warning', 'Data tidak bisa di hapus karena ada pengguna');
                return false;
            }
        });
    }

    public function pengguna()
    {
        return $this->hasMany(Tb_pengguna::class, 'id_wilayah');
    }

    public function sdm()
    {
        return $this->hasMany(Tb_sdm::class, 'id_wilayah');
    }

    public function kelembagaan()
    {
        return $this->hasMany(Tb_kelembagaan::class, 'id_wilayah');
    }
}
