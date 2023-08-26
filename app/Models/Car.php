<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Car extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
      'model',
      'brand',
      'plate_number',
      'category',
      'year',
      'place',
      'vehicule_info',
       'media',
       'qrCode'
    ];

    public function addMediaFromRequest($requestField)
    {
        return $this->addMediaFromRequest($requestField)->toMediaCollection('car_info');
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function carInformation(): BelongsToMany
    {
        return $this->belongsToMany(CarInformation::class);
    }
}
