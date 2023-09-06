<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Information extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = [
        'title',
        'content'
    ];

    //media store
    public function addMediaFromRequest($requestField)
    {
        return $this->addMediaFromRequest($requestField)->toMediaCollection('information_home');
    }
}
