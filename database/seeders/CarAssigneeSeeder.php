<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarAssignee;
use App\Models\Car;

class CarAssigneeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assicurati che ci siano dei veicoli prima di creare le assegnazioni
        $cars = Car::all();

        if ($cars->isEmpty()) {
            $this->command->warn('Nessun veicolo trovato. Esegui prima CarSeeder o crea alcuni veicoli.');
            return;
        }

        $carAssignees = [
            // Dirigenti e Funzionari di Alto Livello
            [
                'car_id' => $cars->random()->id,
                'name' => 'Dott. Mario Rossi',
                'description' => 'Direttore Generale - Ministero dell\'Interno',
                'date_from' => now()->subMonths(8),
                'date_to' => null,
                'note' => 'Assegnazione a tempo indeterminato per esigenze istituzionali di rappresentanza e mobilità.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Dott.ssa Anna Bianchi',
                'description' => 'Dirigente Amministrativo - Comune di Roma',
                'date_from' => now()->subMonths(6),
                'date_to' => null,
                'note' => 'Veicolo per attività ispettive e coordinamento servizi territoriali.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Ing. Giuseppe Verdi',
                'description' => 'Capo Ufficio Tecnico - Provincia di Milano',
                'date_from' => now()->subMonths(4),
                'date_to' => now()->addMonths(8),
                'note' => 'Assegnazione temporanea per progetto infrastrutture stradali provinciali.'
            ],

            // Forze dell\'Ordine
            [
                'car_id' => $cars->random()->id,
                'name' => 'Commissario Capo Luigi Esposito',
                'description' => 'Commissario Capo - Questura di Roma',
                'date_from' => now()->subMonths(12),
                'date_to' => null,
                'note' => 'Veicolo operativo per servizi di ordine pubblico e coordinamento territoriale.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Ispettore Superiore Marco Ferrari',
                'description' => 'Ispettore Capo - Squadra Mobile',
                'date_from' => now()->subMonths(3),
                'date_to' => null,
                'note' => 'Assegnazione per attività investigative e servizi di polizia giudiziaria.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Capitano Andrea Romano',
                'description' => 'Capitano - Compagnia Carabinieri Centro',
                'date_from' => now()->subMonths(7),
                'date_to' => null,
                'note' => 'Veicolo di comando per coordinamento pattuglie e servizi di controllo territorio.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Tenente Colonnello Paolo Conti',
                'description' => 'Comandante - Nucleo Guardia di Finanza',
                'date_from' => now()->subMonths(5),
                'date_to' => null,
                'note' => 'Assegnazione per attività di controllo economico-finanziario e coordinamento reparti.'
            ],

            // Uffici e Servizi
            [
                'car_id' => $cars->random()->id,
                'name' => 'Ufficio Tecnico Comunale',
                'description' => 'Servizio Manutenzioni e Lavori Pubblici',
                'date_from' => now()->subMonths(10),
                'date_to' => null,
                'note' => 'Veicolo per sopralluoghi, controlli cantieri e attività manutentive sul territorio.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Servizio Sociale Territoriale',
                'description' => 'Assistenza Domiciliare e Servizi alla Persona',
                'date_from' => now()->subMonths(9),
                'date_to' => null,
                'note' => 'Mezzo per visite domiciliari, trasporto assistiti e attività sociosanitarie.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Reparto Ambiente e Verde',
                'description' => 'Tutela Ambientale e Gestione Verde Pubblico',
                'date_from' => now()->subMonths(2),
                'date_to' => null,
                'note' => 'Veicolo per controlli ambientali, gestione parchi e attività di educazione ambientale.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Ufficio Cultura e Turismo',
                'description' => 'Promozione Culturale e Turistica',
                'date_from' => now()->subMonths(6),
                'date_to' => now()->addMonths(6),
                'note' => 'Assegnazione temporanea per eventi culturali stagionali e attività promozionali.'
            ],

            // Servizi Sanitari
            [
                'car_id' => $cars->random()->id,
                'name' => 'Dr. Maria Neri',
                'description' => 'Direttore Sanitario - ASL Roma 1',
                'date_from' => now()->subMonths(11),
                'date_to' => null,
                'note' => 'Veicolo per visite ispettive strutture sanitarie e coordinamento servizi territoriali.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Servizio 118 Territoriale',
                'description' => 'Coordinamento Emergenze Sanitarie',
                'date_from' => now()->subMonths(4),
                'date_to' => null,
                'note' => 'Automedica di supporto per emergenze e trasferimenti sanitari urgenti.'
            ],

            // Servizi Specializzati
            [
                'car_id' => $cars->random()->id,
                'name' => 'Nucleo Cinofili',
                'description' => 'Unità Cinofila Antidroga',
                'date_from' => now()->subMonths(8),
                'date_to' => null,
                'note' => 'Veicolo attrezzato per trasporto unità cinofile e attrezzature specialistiche.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Squadra Artificieri',
                'description' => 'Nucleo Artificieri - Bonifica Ordigni',
                'date_from' => now()->subMonths(15),
                'date_to' => null,
                'note' => 'Mezzo specializzato per interventi bonifica e trasporto equipaggiamenti EOD.'
            ],

            // Assegnazioni Temporanee/Scadute
            [
                'car_id' => $cars->random()->id,
                'name' => 'Dott. Francesco Blu',
                'description' => 'Commissario Straordinario',
                'date_from' => now()->subYear(),
                'date_to' => now()->subMonths(2),
                'note' => 'Assegnazione terminata al completamento mandato commissariale per riorganizzazione ente.'
            ],
            [
                'car_id' => $cars->random()->id,
                'name' => 'Task Force Emergenza COVID',
                'description' => 'Coordinamento Emergenza Sanitaria',
                'date_from' => now()->subMonths(18),
                'date_to' => now()->subMonths(6),
                'note' => 'Assegnazione speciale durante emergenza pandemica per coordinamento attività sanitarie.'
            ],

            // Assegnazioni Future
            [
                'car_id' => $cars->random()->id,
                'name' => 'Commissione Esami Patenti',
                'description' => 'Servizio Motorizzazione Civile',
                'date_from' => now()->addDays(15),
                'date_to' => now()->addMonths(3),
                'note' => 'Assegnazione programmata per sessione esami estiva e attività di controllo.'
            ],

            // Servizi di Vigilanza
            [
                'car_id' => $cars->random()->id,
                'name' => 'Corpo Guardie Particolari Giurate',
                'description' => 'Vigilanza Edifici Pubblici',
                'date_from' => now()->subMonths(5),
                'date_to' => null,
                'note' => 'Pattugliamento notturno edifici istituzionali e controllo accessi.'
            ],

            // Protezione Civile
            [
                'car_id' => $cars->random()->id,
                'name' => 'Coordinamento Protezione Civile',
                'description' => 'Gestione Emergenze e Prevenzione Rischi',
                'date_from' => now()->subMonths(13),
                'date_to' => null,
                'note' => 'Veicolo dotato di equipaggiamenti per interventi emergenza e coordinamento volontari.'
            ],

            // Servizi Educativi
            [
                'car_id' => $cars->random()->id,
                'name' => 'Servizio Scuolabus',
                'description' => 'Trasporto Scolastico Comunale',
                'date_from' => now()->subMonths(3),
                'date_to' => now()->addMonths(9),
                'note' => 'Assegnazione per anno scolastico 2024/2025 - trasporto studenti zone rurali.'
            ]
        ];

        foreach ($carAssignees as $carAssignee) {
            // Controlla che il veicolo esista ancora
            if (Car::find($carAssignee['car_id'])) {
                CarAssignee::create($carAssignee);
            }
        }
    }
}

// Per eseguire il seeder:
// php artisan db:seed --class=CarAssigneeSeeder

// Oppure aggiungi in DatabaseSeeder.php:
// $this->call(CarAssigneeSeeder::class);

// IMPORTANTE: Esegui questo seeder DOPO aver creato i veicoli
// Ordine consigliato:
// 1. CarTypeSeeder, CarBrandSeeder, CarPowerSeeder, CarOwnerSeeder
// 2. CarSeeder (con alcuni veicoli di esempio)
// 3. CarPlateSeeder
// 4. CarAssigneeSeeder (questo file)
