<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HomeAdmin extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = [
        'title',
        'content',
        'posted_by', 
        'media'
    ];
    public function addMediaFromRequest($requestField)
    {
        return $this->addMediaFromRequest($requestField)->toMediaCollection('home_collection');
    }

}
