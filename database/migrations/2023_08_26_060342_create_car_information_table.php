<?php

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
        Schema::create('car_information', function (Blueprint $table) {
            $table->id();
            $table->string('car');
            $table->string('kilometers');
            $table->string('max_fuel');
            $table->string('max_weight');
            $table->string('min_weight');
            $table->date('maintains');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_information');
    }
};
