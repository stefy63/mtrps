<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cigs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('maintenance_garage_id')->nullable();
            $table->unsignedBigInteger('user_rup_id')->nullable();
            $table->unsignedBigInteger('user_support_id')->nullable();
            $table->unsignedBigInteger('user_tender_notice_id')->nullable();
            $table->unsignedBigInteger('user_tester_id')->nullable();
            $table->date('date')->nullable();
            $table->string('ce')->nullable();
            $table->string('description')->nullable();
            $table->string('preventive')->nullable();
            $table->string('final_report')->nullable();
            $table->string('taxable')->nullable();
            $table->string('vat')->nullable();
            $table->string('cig')->nullable();
            $table->string('note')->nullable();
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('maintenance_garage_id')->references('id')->on('maintenance_garages');
            $table->foreign('user_rup_id')->references('id')->on('users');
            $table->foreign('user_support_id')->references('id')->on('users');
            $table->foreign('user_tender_notice_id')->references('id')->on('users');
            $table->foreign('user_tester_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cigs');
    }
};
