<?php

use Database\Seeders\MaintenanceGarageSeeder;
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
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('piva')->nullable();
            $table->string('cf')->nullable();
            $table->string('iban')->nullable();
            $table->string('mail')->nullable();
            $table->string('pec')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->enum('acc', ['yes', 'no'])->default('no');
            $table->enum('anti_mafia', ['yes', 'no'])->default('no');
            $table->date('durc')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
        $garageSeeder = new MaintenanceGarageSeeder();
        $garageSeeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_garages');
    }
};
