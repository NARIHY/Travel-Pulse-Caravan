<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CarInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'car',
        'kilometers',
        'max_fuel',
        'max_weight',
        'min_weight',
        'maintains'
    ];

    public function car(): BelongsToMany
    {
        return $this->belongsToMany(Car::class);
    }
}
