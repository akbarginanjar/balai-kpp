<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_keuntungan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function gambar()
    {
        if ($this->gambar && file_exists(public_path('images/keuntungan/gambar/' . $this->gambar))) {
            return asset('images/keuntungan/gambar/' . $this->gambar);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deletegambar()
    {
        if ($this->gambar && file_exists(public_path('images/keuntungan/gambar/' . $this->gambar))) {
            return unlink(public_path('images/keuntungan/gambar/' . $this->gambar));
        }
    }
}
