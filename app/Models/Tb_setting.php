<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_setting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function icon()
    {
        if ($this->icon && file_exists(public_path('images/ikon/' . $this->icon))) {
            return asset('images/ikon/' . $this->icon);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteicon()
    {
        if ($this->icon && file_exists(public_path('images/ikon/' . $this->icon))) {
            return unlink(public_path('images/ikon/' . $this->icon));
        }
    }
}
