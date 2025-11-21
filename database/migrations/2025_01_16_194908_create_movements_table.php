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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->string('code')->unique();
            $table->date('date_from')->useCurrent();
            $table->date('date_to')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indici e foreign keys
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('set null');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
