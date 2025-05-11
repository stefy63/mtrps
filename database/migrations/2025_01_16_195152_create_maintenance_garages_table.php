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
        Schema::create('maintenance_garages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_id')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('piva')->nullable();
            $table->string('cf')->nullable();
            $table->string('iban')->nullable();
            $table->string('pec')->nullable();
            $table->enum('acc', ['yes', 'no'])->default('no');
            $table->enum('anti_mafia', ['yes', 'no'])->default('no');
            $table->date('durc')->nullable();
            $table->string('description')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('maintenance_id')->references('id')->on('maintenances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_garages');
    }
};
