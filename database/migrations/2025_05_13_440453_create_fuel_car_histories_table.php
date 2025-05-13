<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('fuel_car_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('car_fuel_id')->nullable();
            $table->date('date')->useCurrent();
            $table->integer('quantity')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('car_fuel_id')->references('id')->on('car_fuels');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuel_car_histories');
    }
};
