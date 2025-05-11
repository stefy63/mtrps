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
        Schema::create('assignee_offices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_assignee_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('car_assignee_id')->references('id')->on('car_assignees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignee_offices');
    }
};
