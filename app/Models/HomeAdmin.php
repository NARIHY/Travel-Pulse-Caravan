<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'picture',
        'video',
        'posted_by'
    ];
}
