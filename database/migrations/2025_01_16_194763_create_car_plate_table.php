<?php

use App\Enum\PlateTypeEnum;
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
        Schema::create('car_plate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('plate_id')->nullable();
            $table->date('date_from')->useCurrent();
            $table->date('date_to')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('set null');
            $table->foreign('plate_id')->references('id')->on('plates')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_plate');
    }
};
