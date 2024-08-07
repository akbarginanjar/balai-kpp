<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_subscribe extends Model
{
    use HasFactory;

    protected $table = 'tb_subscribers';

    protected $guarded = ['id'];
}