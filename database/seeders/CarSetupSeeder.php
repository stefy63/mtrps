<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\CarSetup;
use Carbon\Carbon;

class CarSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = Car::all();

        if ($cars->isEmpty()) {
            $this->command->warn('Nessun veicolo trovato. Esegui prima CarSeeder.');
            return;
        }

        $setups = [
            // SICUREZZA
            [
                'name' => 'Blindatura leggera B4',
                'description' => 'Protezione balistica livello B4 per trasporto autorità',
                'car_types' => ['berlina', 'suv'],
                'duration' => null // Permanente
            ],
            [
                'name' => 'Vetri antiproiettile',
                'description' => 'Vetri blindati certificati per protezione personale',
                'car_types' => ['berlina', 'suv'],
                'duration' => null
            ],
            [
                'name' => 'Sistema run-flat pneumatici',
                'description' => 'Pneumatici antiforatura per mobilità in emergenza',
                'car_types' => ['berlina', 'suv', 'furgone'],
                'duration' => null
            ],
            [
                'name' => 'Jammers anti-esplosivo',
                'description' => 'Sistema di disturbo frequenze per IED',
                'car_types' => ['suv'],
                'duration' => 365
            ],

            // COMUNICAZIONE
            [
                'name' => 'Radio TETRA/DMR',
                'description' => 'Sistema radio digitale per comunicazioni sicure',
                'car_types' => ['berlina', 'suv', 'furgone', 'pickup'],
                'duration' => null
            ],
            [
                'name' => 'Ponte radio mobile',
                'description' => 'Ripetitore mobile per estensione copertura radio',
                'car_types' => ['furgone', 'pickup'],
                'duration' => 180
            ],
            [
                'name' => 'Sistema satellitare BGAN',
                'description' => 'Connettività satellitare banda larga per zone remote',
                'car_types' => ['furgone', 'suv'],
                'duration' => null
            ],
            [
                'name' => 'Router 5G con ridondanza',
                'description' => 'Connettività mobile multi-operatore ad alta velocità',
                'car_types' => ['furgone', 'autobus'],
                'duration' => null
            ],

            // EMERGENZA
            [
                'name' => 'Kit medicale avanzato',
                'description' => 'Equipaggiamento medico per primo soccorso avanzato',
                'car_types' => ['ambulanza', 'suv', 'furgone'],
                'duration' => null
            ],
            [
                'name' => 'Defibrillatore DAE',
                'description' => 'Defibrillatore automatico esterno con kit pediatrico',
                'car_types' => ['ambulanza', 'suv', 'autobus'],
                'duration' => null
            ],
            [
                'name' => 'Barella e immobilizzatori',
                'description' => 'Sistema completo per trasporto e immobilizzazione pazienti',
                'car_types' => ['ambulanza', 'furgone'],
                'duration' => null
            ],
            [
                'name' => 'Equipaggiamento NBCR',
                'description' => 'Kit protezione nucleare, biologica, chimica e radiologica',
                'car_types' => ['furgone', 'suv'],
                'duration' => 365
            ],

            // OPERATIVO
            [
                'name' => 'Postazione comando mobile',
                'description' => 'Centro operativo mobile con postazioni di lavoro',
                'car_types' => ['furgone', 'autobus'],
                'duration' => null
            ],
            [
                'name' => 'Sistema videosorveglianza 360°',
                'description' => 'Telecamere perimetrali con registrazione e analisi video',
                'car_types' => ['furgone', 'suv'],
                'duration' => null
            ],
            [
                'name' => 'Generatore ausiliario',
                'description' => 'Gruppo elettrogeno integrato 5kW',
                'car_types' => ['furgone', 'autobus'],
                'duration' => null
            ],
            [
                'name' => 'Inverter 220V potenza elevata',
                'description' => 'Sistema di alimentazione 220V 3000W',
                'car_types' => ['furgone', 'pickup', 'suv'],
                'duration' => null
            ],

            // SPECIALE
            [
                'name' => 'Laboratorio mobile analisi',
                'description' => 'Laboratorio attrezzato per analisi chimiche/biologiche',
                'car_types' => ['furgone'],
                'duration' => 730
            ],
            [
                'name' => 'Ufficio anagrafe mobile',
                'description' => 'Sportello mobile per servizi anagrafici',
                'car_types' => ['furgone', 'autobus'],
                'duration' => 180
            ],
            [
                'name' => 'Aula formazione mobile',
                'description' => 'Aula attrezzata con postazioni e videoproiettore',
                'car_types' => ['autobus'],
                'duration' => 365
            ],
            [
                'name' => 'Cucina da campo',
                'description' => 'Cucina mobile completa per emergenze',
                'car_types' => ['furgone'],
                'duration' => 90
            ],

            // TRASPORTO
            [
                'name' => 'Trasporto detenuti',
                'description' => 'Allestimento con celle separate e sistemi di sicurezza',
                'car_types' => ['furgone'],
                'duration' => null
            ],
            [
                'name' => 'Trasporto valori',
                'description' => 'Cassaforte integrata e sistemi di sicurezza avanzati',
                'car_types' => ['furgone'],
                'duration' => null
            ],
            [
                'name' => 'Trasporto disabili',
                'description' => 'Pedana elettrica e ancoraggi per carrozzine',
                'car_types' => ['furgone', 'autobus'],
                'duration' => null
            ],
            [
                'name' => 'Cella frigorifera',
                'description' => 'Vano refrigerato per trasporto materiale termosensibile',
                'car_types' => ['furgone'],
                'duration' => null
            ],

            // TECNOLOGIA
            [
                'name' => 'Drone con docking station',
                'description' => 'Sistema drone automatico per ricognizione aerea',
                'car_types' => ['suv', 'furgone'],
                'duration' => 365
            ],
            [
                'name' => 'Scanner biometrico',
                'description' => 'Sistema riconoscimento biometrico mobile',
                'car_types' => ['suv', 'furgone'],
                'duration' => null
            ],
            [
                'name' => 'Lettore targa ANPR mobile',
                'description' => 'Sistema automatico lettura targhe con database',
                'car_types' => ['berlina', 'suv'],
                'duration' => null
            ],
            [
                'name' => 'Termocamera FLIR',
                'description' => 'Telecamera termica per ricerca e soccorso',
                'car_types' => ['suv', 'pickup'],
                'duration' => null
            ]
        ];

        foreach ($cars->random(min(20, $cars->count())) as $car) {
            // Determina il tipo di veicolo
            $carTypeName = strtolower($car->carType->name ?? '');

            // Filtra gli allestimenti appropriati per il tipo di veicolo
            $appropriateSetups = array_filter($setups, function($setup) use ($carTypeName) {
                foreach ($setup['car_types'] as $type) {
                    if (stripos($carTypeName, $type) !== false) {
                        return true;
                    }
                }
                return false;
            });

            if (empty($appropriateSetups)) {
                // Se non ci sono setup specifici, prendi alcuni generici
                $appropriateSetups = array_slice($setups, 0, 5);
            }

            // Seleziona 1-3 allestimenti casuali
            $selectedSetups = array_rand($appropriateSetups, min(rand(1, 3), count($appropriateSetups)));
            if (!is_array($selectedSetups)) {
                $selectedSetups = [$selectedSetups];
            }

            foreach ($selectedSetups as $index) {
                $setup = $appropriateSetups[array_keys($appropriateSetups)[$index]];

                // Determina le date
                $startDate = Carbon::now()->subDays(rand(30, 730));
                $endDate = null;

                if ($setup['duration'] !== null) {
                    // 70% di probabilità che sia ancora attivo
                    if (rand(1, 100) > 70) {
                        $endDate = $startDate->copy()->addDays($setup['duration']);
                    }
                } else {
                    // Per allestimenti permanenti, 20% di probabilità che siano conclusi
                    if (rand(1, 100) <= 20) {
                        $endDate = Carbon::now()->subDays(rand(1, 30));
                    }
                }

                // Note aggiuntive casuali
                $notes = [
                    'Installazione certificata secondo normative vigenti',
                    'Manutenzione programmata ogni 6 mesi',
                    'Sistema testato e collaudato con esito positivo',
                    'Formazione operatori completata',
                    'Garanzia estesa 24 mesi',
                    'Assistenza H24 disponibile',
                    'Documentazione tecnica completa in dotazione',
                    'Integrazione con sistemi esistenti verificata'
                ];

                CarSetup::create([
                    'car_id' => $car->id,
                    'name' => $setup['name'],
                    'description' => $setup['description'],
                    'date_from' => $startDate,
                    'date_to' => $endDate,
                    'note' => rand(1, 100) > 50 ? $notes[array_rand($notes)] : null
                ]);
            }
        }

        $this->command->info('CarSetup seeding completato!');
    }
}
