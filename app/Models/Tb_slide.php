<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_slide extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['deskripsi', 'gambar'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function gambar()
    {
        if ($this->gambar && file_exists(public_path('images/slide/' . $this->gambar))) {
            return asset('images/slide/' . $this->gambar);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteGambar()
    {
        if ($this->gambar && file_exists(public_path('images/slide/' . $this->gambar))) {
            return unlink(public_path('images/slide/' . $this->gambar));
        }
    }
}
