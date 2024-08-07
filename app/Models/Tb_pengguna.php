<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_pengguna extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function wilayah()
    {
        return $this->belongsTo(Tb_wilayah::class, 'id_wilayah');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
