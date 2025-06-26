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
        Schema::create('car_profit_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('category')->nullable(); // categoria centro di costo
            $table->string('department')->nullable(); // dipartimento/ufficio
            $table->string('responsible')->nullable(); // responsabile centro di costo
            $table->string('email')->nullable(); // email responsabile
            $table->string('phone')->nullable(); // telefono responsabile
            $table->decimal('budget_year', 12, 2)->nullable(); // budget annuale
            $table->decimal('budget_month', 10, 2)->nullable(); // budget mensile
            $table->boolean('is_active')->default(true); // attivo/disattivo
            $table->date('valid_from')->nullable(); // validità da
            $table->date('valid_to')->nullable(); // validità a
            $table->text('notes')->nullable(); // note
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            // Indici
            $table->index('code');
            $table->index('category');
            $table->index('is_active');

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_profit_accounts');
    }
};
