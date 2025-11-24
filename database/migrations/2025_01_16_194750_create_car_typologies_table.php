<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('car_typologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        $typology = new \Database\Seeders\CarTypologySeeder();
        $typology->run();
    }

    public function down(): void
    {
        Schema::dropIfExists('car_typologies');
    }
};
