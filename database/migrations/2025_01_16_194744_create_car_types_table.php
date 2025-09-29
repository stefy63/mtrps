<?php

use Database\Seeders\CarTypeSeeder;
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
        Schema::create('car_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employment_code_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('employment_code_id')->references('id')->on('employment_codes')->onDelete('set null');
        });
        $catTypes = new CarTypeSeeder();
        $catTypes->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_types');
    }
};
