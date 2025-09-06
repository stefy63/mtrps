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

            // Relazioni principali
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('driver_id'); // conducente
            $table->unsignedBigInteger('requested_by')->nullable(); // richiedente
            $table->unsignedBigInteger('authorized_by')->nullable(); // autorizzante

            // Informazioni base movimento
            $table->string('code')->unique(); // codice movimento (es: MOV-2025-00001)
            $table->enum('status', ['pending', 'approved', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->enum('type', ['servizio', 'missione', 'trasferimento', 'emergenza', 'manutenzione', 'altro'])->default('servizio');
            $table->string('purpose'); // scopo/motivo della missione
            $table->text('purpose_details')->nullable(); // dettagli aggiuntivi

            // Date e orari
            $table->dateTime('departure_datetime'); // partenza prevista
            $table->dateTime('arrival_datetime'); // arrivo previsto
            $table->dateTime('actual_departure')->nullable(); // partenza effettiva
            $table->dateTime('actual_arrival')->nullable(); // arrivo effettivo

            // Località
            $table->string('departure_location'); // luogo partenza
            $table->string('departure_address')->nullable(); // indirizzo completo partenza
            $table->decimal('departure_lat', 10, 7)->nullable(); // coordinate GPS
            $table->decimal('departure_lng', 10, 7)->nullable();

            $table->string('arrival_location'); // luogo arrivo
            $table->string('arrival_address')->nullable(); // indirizzo completo arrivo
            $table->decimal('arrival_lat', 10, 7)->nullable(); // coordinate GPS
            $table->decimal('arrival_lng', 10, 7)->nullable();

            // Percorso e chilometraggio
            $table->unsignedInteger('km_start')->nullable(); // km iniziali
            $table->unsignedInteger('km_end')->nullable(); // km finali
            $table->unsignedInteger('km_total')->nullable(); // km percorsi (calcolato)
            $table->unsignedInteger('estimated_km')->nullable(); // km stimati
            $table->unsignedInteger('estimated_duration')->nullable(); // durata stimata in minuti
            $table->string('route_type')->nullable(); // tipo percorso (autostrada, urbano, misto)

            // Passeggeri
            $table->unsignedInteger('passengers_count')->default(0); // numero passeggeri
            $table->json('passengers')->nullable(); // array di user_id dei passeggeri
            $table->text('external_passengers')->nullable(); // passeggeri esterni (non utenti)

            // Costi e consumi
            $table->decimal('fuel_liters', 8, 2)->nullable(); // litri carburante consumati
            $table->decimal('fuel_cost', 8, 2)->nullable(); // costo carburante
            $table->decimal('toll_cost', 8, 2)->nullable(); // costo pedaggi
            $table->decimal('parking_cost', 8, 2)->nullable(); // costo parcheggi
            $table->decimal('other_costs', 8, 2)->nullable(); // altri costi
            $table->string('cost_notes')->nullable(); // note sui costi

            // Documenti e note
            $table->string('mission_order')->nullable(); // numero ordine di missione
            $table->text('notes')->nullable(); // note generali
            $table->text('incidents')->nullable(); // incidenti/problemi durante il viaggio
            $table->boolean('requires_overnight')->default(false); // pernottamento necessario
            $table->string('overnight_location')->nullable(); // luogo pernottamento

            // Validazioni e controlli
            $table->boolean('vehicle_check_before')->default(false); // controllo veicolo pre-partenza
            $table->boolean('vehicle_check_after')->default(false); // controllo veicolo post-arrivo
            $table->text('vehicle_damages')->nullable(); // eventuali danni riscontrati

            // Metadati
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes(); // per mantenere storico anche di movimenti cancellati

            // Indici e foreign keys
            $table->index(['car_id', 'departure_datetime', 'arrival_datetime']);
            $table->index(['status', 'type']);
            $table->index('code');
            $table->index('departure_datetime');
            $table->index('driver_id');

            $table->foreign('car_id')->references('id')->on('cars')->onDelete('restrict');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('requested_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('authorized_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
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
