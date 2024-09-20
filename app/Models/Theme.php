<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
        use HasFactory;

        protected $fillable = [
            'name',
            'id_in_s3',
            'background_image',
            'card_background',
        ];
}
