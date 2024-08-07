<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_submenu extends Model
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

    public function menu()
    {
        return $this->belongsTo(Tb_menu::class, 'id_menu');
    }
}
