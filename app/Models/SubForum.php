<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubForum extends Model
{
    use HasFactory;

    public function replies() {
        return $this->hasMany(SubForum::class); // Adjust based on your actual reply model
    }
}
