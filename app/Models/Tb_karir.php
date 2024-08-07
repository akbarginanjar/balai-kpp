<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_karir extends Model
{
    use HasFactory;

    protected $visible = ['judul', 'isi'];
    
    protected $fillable = ['judul', 'isi'];

    public $timestamps = true;
}
