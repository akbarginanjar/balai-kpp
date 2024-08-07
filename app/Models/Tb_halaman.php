<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_halaman extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tb_halamans";
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function konten()
    {
        return $this->hasMany(Tb_konten::class, 'id_halaman');
    }

    public function gambar()
    {
        if ($this->gambar && file_exists(public_path('images/halaman/' . $this->gambar))) {
            return asset('images/halaman/' . $this->gambar);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteGambar()
    {
        if ($this->gambar && file_exists(public_path('images/halaman/' . $this->gambar))) {
            return unlink(public_path('images/halaman/' . $this->gambar));
        }
    }
}
