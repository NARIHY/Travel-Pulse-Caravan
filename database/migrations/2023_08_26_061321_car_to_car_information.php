<?php

use App\Models\Car;
use App\Models\CarInformation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_car_information', function (Blueprint $table) {
            $table->foreignIdFor(Car::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CarInformation::class)->constrained()->cascadeOnDelete();
            $table->primary(['car_id', 'car_information_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_car_information');
    }
};
