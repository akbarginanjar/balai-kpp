<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_faq extends Model
{
    use HasFactory;

    protected $fillable = ['pertanyaan', 'jawaban'];

    protected $visible = ['pertanyaan', 'jawaban'];

    public $timestamps = true;
}
