<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_type_id')->nullable();
            $table->unsignedBigInteger('car_owner_id')->nullable();
            $table->unsignedBigInteger('car_brand_id')->nullable();
            $table->unsignedBigInteger('car_power_id')->nullable();
            $table->unsignedBigInteger('car_profit_account_id')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('cod_model')->nullable();
            $table->string('profit_account')->nullable();
            $table->unsignedBigInteger('tank')->nullable();
            $table->unsignedBigInteger('km')->nullable();
            $table->string('description')->nullable();
            $table->boolean('winter_wheels')->default(false);
            $table->string('wheels_type')->nullable();
            $table->string('warranty')->nullable();
            $table->string('tel_warranty')->nullable();
            $table->string('chassis')->nullable();
            $table->date('date_revision')->nullable();
            $table->date('doc')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('created_by')->unsigned()->nullable();
            $table->unsignedBigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('created_by', 'createdBy')->references('id')->on('users');
            $table->foreign('updated_by', 'updateBy')->references('id')->on('users');
            $table->foreign('car_type_id')->references('id')->on('car_types');
            $table->foreign('car_owner_id')->references('id')->on('car_owners');
            $table->foreign('car_brand_id')->references('id')->on('car_brands');
            $table->foreign('car_power_id')->references('id')->on('car_powers');
            $table->foreign('car_profit_account_id')->references('id')->on('car_profit_accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
