<?php

namespace App\Models;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_tentang_kami extends Model
{
    use HasFactory;

    protected $visible = ['judul', 'isi'];

    protected $fillable = ['judul', 'isi'];

    public $timestamps = true;
}
