<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';
    protected $fillable = [
        'short_url',
        'views',
        'user_id',
        'original_url',
    ];
}
