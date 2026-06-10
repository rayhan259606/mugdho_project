<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeMedia extends Model
{
    protected $table = 'home_media';

    protected $fillable = [
        'type',
        'title',
        'file_path',
        'link',
        'status',
    ];
}
