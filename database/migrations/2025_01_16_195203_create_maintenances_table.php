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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('maintenance_garages_id')->nullable();
            $table->unsignedBigInteger('maintenance_types_id')->nullable();
            $table->date('date_from')->useCurrent();
            $table->date('date_to')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('set null');
            $table->foreign('maintenance_garages_id')->references('id')->on('maintenance_garages');
            $table->foreign('maintenance_types_id')->references('id')->on('maintenance_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
