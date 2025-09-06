<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movement;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;

class MovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');

        // Recupera dati necessari
        $cars = Car::all();
        $users = User::all();

        if ($cars->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Necessari veicoli e utenti nel database. Esegui prima CarSeeder e UserSeeder.');
            return;
        }

        // Destinazioni frequenti per enti pubblici italiani
        $destinations = [
            // Roma
            ['location' => 'Palazzo del Quirinale', 'address' => 'Piazza del Quirinale, 00187 Roma', 'lat' => 41.8996, 'lng' => 12.4869],
            ['location' => 'Palazzo Chigi', 'address' => 'Piazza Colonna, 370, 00187 Roma', 'lat' => 41.9010, 'lng' => 12.4805],
            ['location' => 'Ministero dell\'Interno', 'address' => 'Piazza del Viminale, 1, 00184 Roma', 'lat' => 41.9016, 'lng' => 12.4969],
            ['location' => 'Aeroporto di Fiumicino', 'address' => 'Via dell\'Aeroporto di Fiumicino, 00054 Fiumicino RM', 'lat' => 41.8003, 'lng' => 12.2389],
            ['location' => 'Stazione Termini', 'address' => 'Piazza dei Cinquecento, 00185 Roma', 'lat' => 41.9009, 'lng' => 12.5013],
            ['location' => 'Camera dei Deputati', 'address' => 'Piazza di Monte Citorio, 00186 Roma', 'lat' => 41.9013, 'lng' => 12.4787],
            ['location' => 'Senato della Repubblica', 'address' => 'Piazza Madama, 00186 Roma', 'lat' => 41.8992, 'lng' => 12.4744],
            ['location' => 'EUR - Palazzo dei Congressi', 'address' => 'Piazza John Kennedy, 1, 00144 Roma', 'lat' => 41.8350, 'lng' => 12.4693],

            // Milano
            ['location' => 'Palazzo Lombardia', 'address' => 'Piazza Città di Lombardia, 1, 20124 Milano', 'lat' => 45.4836, 'lng' => 9.1950],
            ['location' => 'Questura di Milano', 'address' => 'Via Fatebenefratelli, 11, 20121 Milano', 'lat' => 45.4753, 'lng' => 9.1896],
            ['location' => 'Aeroporto di Malpensa', 'address' => 'Via Malpensa, 21010 Ferno VA', 'lat' => 45.6306, 'lng' => 8.7281],
            ['location' => 'Stazione Centrale Milano', 'address' => 'Piazza Duca d\'Aosta, 1, 20124 Milano', 'lat' => 45.4854, 'lng' => 9.2045],
            ['location' => 'Fiera Milano Rho', 'address' => 'Strada Statale Sempione, 28, 20017 Rho MI', 'lat' => 45.5201, 'lng' => 9.0874],
            ['location' => 'Tribunale di Milano', 'address' => 'Via Freguglia, 1, 20122 Milano', 'lat' => 45.4619, 'lng' => 9.1852],

            // Altre città
            ['location' => 'Questura di Torino', 'address' => 'Corso Vinzaglio, 10, 10121 Torino', 'lat' => 45.0653, 'lng' => 7.6688],
            ['location' => 'Palazzo Vecchio - Firenze', 'address' => 'Piazza della Signoria, 50122 Firenze', 'lat' => 43.7696, 'lng' => 11.2558],
            ['location' => 'Questura di Napoli', 'address' => 'Via Medina, 75, 80133 Napoli', 'lat' => 40.8418, 'lng' => 14.2527],
            ['location' => 'Palazzo delle Aquile - Palermo', 'address' => 'Piazza Pretoria, 1, 90133 Palermo', 'lat' => 38.1157, 'lng' => 13.3613],
            ['location' => 'Ca\' Farsetti - Venezia', 'address' => 'San Marco, 4136, 30124 Venezia', 'lat' => 45.4337, 'lng' => 12.3378],
            ['location' => 'Questura di Bologna', 'address' => 'Piazza Galileo Galilei, 7, 40123 Bologna', 'lat' => 44.5009, 'lng' => 11.3463],
        ];

        // Scopi tipici per movimenti PA
        $purposes = [
            'servizio' => [
                'Riunione istituzionale presso Ministero',
                'Convocazione urgente Prefettura',
                'Consegna documenti riservati',
                'Scorta personalità',
                'Trasporto delegazione ministeriale',
                'Partecipazione cerimonia ufficiale',
                'Incontro interistituzionale',
                'Riunione comitato sicurezza',
            ],
            'missione' => [
                'Sopralluogo tecnico cantiere',
                'Ispezione strutture',
                'Verifica conformità impianti',
                'Controllo territorio',
                'Attività investigativa',
                'Missione formativa',
                'Partecipazione corso aggiornamento',
                'Audit amministrativo',
            ],
            'trasferimento' => [
                'Trasferimento veicolo altra sede',
                'Spostamento per manutenzione',
                'Riassegnazione temporanea mezzo',
                'Trasferimento per evento speciale',
                'Movimentazione parco auto',
            ],
            'emergenza' => [
                'Intervento emergenza protezione civile',
                'Supporto calamità naturale',
                'Emergenza ordine pubblico',
                'Intervento sanitario urgente',
                'Evacuazione preventiva',
            ],
        ];

        $this->command->info('Generazione movimenti in corso...');
        $progressBar = $this->command->getOutput()->createProgressBar(150);

        // Genera movimenti per gli ultimi 6 mesi
        for ($i = 0; $i < 150; $i++) {
            $car = $cars->random();
            $driver = $users->random();
            $requester = $users->random();

            // Data partenza negli ultimi 6 mesi
            $daysAgo = rand(0, 180);
            $departureDatetime = Carbon::now()->subDays($daysAgo)->setTime(rand(6, 18), rand(0, 59));

            // Durata del viaggio (da 30 minuti a 8 ore)
            $durationMinutes = rand(30, 480);
            $arrivalDatetime = clone $departureDatetime;
            $arrivalDatetime->addMinutes($durationMinutes);

            // Seleziona partenza e arrivo
            $departure = $faker->randomElement($destinations);
            $arrival = $faker->randomElement($destinations);

            // Assicura che partenza e arrivo siano diversi
            while ($arrival['location'] === $departure['location']) {
                $arrival = $faker->randomElement($destinations);
            }

            // Determina tipo e scopo
            $type = $faker->randomElement(array_keys($purposes));
            $purpose = $faker->randomElement($purposes[$type]);

            // Stato del movimento basato sulla data
            if ($daysAgo > 30) {
                $status = 'completed'; // Movimenti vecchi sono completati
            } elseif ($daysAgo > 7) {
                $status = $faker->randomElement(['completed', 'completed', 'cancelled']); // 2/3 completati
            } elseif ($daysAgo > 1) {
                $status = $faker->randomElement(['approved', 'in_progress', 'completed']);
            } else {
                $status = $faker->randomElement(['pending', 'approved', 'in_progress']);
            }

            // Calcola chilometraggio
            $lastMovement = Movement::where('car_id', $car->id)
                ->where('status', 'completed')
                ->orderBy('arrival_datetime', 'desc')
                ->first();

            $kmStart = $lastMovement ? ($lastMovement->km_end ?? rand(10000, 50000)) : rand(10000, 50000);
            $kmEnd = null;
            $kmTotal = null;

            // Se completato, genera km finali
            if ($status === 'completed') {
                $estimatedKm = $this->calculateEstimatedKm($departure['lat'], $departure['lng'], $arrival['lat'], $arrival['lng']);
                $kmTotal = $estimatedKm + rand(-10, 30); // Variazione realistica
                $kmEnd = $kmStart + $kmTotal;
            }

            // Date effettive per movimenti completati o in corso
            $actualDeparture = null;
            $actualArrival = null;

            if (in_array($status, ['in_progress', 'completed'])) {
                $actualDeparture = clone $departureDatetime;
                $actualDeparture->addMinutes(rand(-15, 30)); // Ritardo/anticipo realistico
            }

            if ($status === 'completed') {
                $actualArrival = clone $arrivalDatetime;
                $actualArrival->addMinutes(rand(-20, 60)); // Variazione arrivo
            }

            // Genera passeggeri
            $hasPassengers = $faker->boolean(60); // 60% ha passeggeri
            $passengers = [];
            $externalPassengers = null;
            $passengersCount = 0;

            if ($hasPassengers) {
                // Passeggeri interni
                $numInternal = rand(0, 3);
                if ($numInternal > 0) {
                    $passengers = $users->random($numInternal)->pluck('id')->toArray();
                    // Rimuovi il conducente dai passeggeri
                    $passengers = array_diff($passengers, [$driver->id]);
                }

                // Passeggeri esterni
                if ($faker->boolean(40)) {
                    $numExternal = rand(1, 3);
                    $externalNames = [];
                    for ($j = 0; $j < $numExternal; $j++) {
                        $externalNames[] = $faker->name;
                    }
                    $externalPassengers = implode(', ', $externalNames);
                }

                $passengersCount = count($passengers) + ($externalPassengers ? count(explode(',', $externalPassengers)) : 0);
            }

            // Genera costi per movimenti completati
            $fuelLiters = null;
            $fuelCost = null;
            $tollCost = null;
            $parkingCost = null;
            $otherCosts = null;

            if ($status === 'completed' && $kmTotal > 0) {
                // Consumo medio 15 km/l
                $fuelLiters = round($kmTotal / 15, 2);
                $fuelCost = round($fuelLiters * $faker->randomFloat(2, 1.8, 2.1), 2);

                // Pedaggi per viaggi lunghi
                if ($kmTotal > 100) {
                    $tollCost = round($kmTotal * 0.08, 2); // 0.08€/km media autostrada
                }

                // Parcheggi occasionali
                if ($faker->boolean(30)) {
                    $parkingCost = $faker->randomFloat(2, 5, 25);
                }

                // Altri costi occasionali
                if ($faker->boolean(20)) {
                    $otherCosts = $faker->randomFloat(2, 10, 50);
                }
            }

            // Note e dettagli aggiuntivi
            $notes = null;
            if ($faker->boolean(30)) {
                $notes = $faker->randomElement([
                    'Viaggio senza particolari problemi',
                    'Traffico intenso sulla tangenziale',
                    'Condizioni meteo avverse',
                    'Deviazione per lavori in corso',
                    'Sosta tecnica programmata',
                ]);
            }

            // Pernottamento per viaggi lunghi
            $requiresOvernight = false;
            $overnightLocation = null;

            if ($durationMinutes > 360 && $faker->boolean(70)) {
                $requiresOvernight = true;
                $overnightLocation = $faker->randomElement([
                    'Hotel Plaza Roma',
                    'Hotel Executive Milano',
                    'Foresteria Ministeriale',
                    'Albergo Centrale',
                    'Hotel Europa',
                ]);
            }

            // Controlli veicolo
            $vehicleCheckBefore = $faker->boolean(80);
            $vehicleCheckAfter = $status === 'completed' ? $faker->boolean(80) : false;

            // Crea il movimento
            $movement = Movement::create([
                'car_id' => $car->id,
                'driver_id' => $driver->id,
                'requested_by' => $requester->id,
                'authorized_by' => in_array($status, ['approved', 'in_progress', 'completed']) ? $users->random()->id : null,
                'code' => Movement::generateCode(),
                'status' => $status,
                'type' => $type,
                'purpose' => $purpose,
                'purpose_details' => $faker->boolean(40) ? $faker->sentence(rand(10, 20)) : null,
                'departure_datetime' => $departureDatetime,
                'arrival_datetime' => $arrivalDatetime,
                'actual_departure' => $actualDeparture,
                'actual_arrival' => $actualArrival,
                'departure_location' => $departure['location'],
                'departure_address' => $departure['address'],
                'departure_lat' => $departure['lat'],
                'departure_lng' => $departure['lng'],
                'arrival_location' => $arrival['location'],
                'arrival_address' => $arrival['address'],
                'arrival_lat' => $arrival['lat'],
                'arrival_lng' => $arrival['lng'],
                'km_start' => $kmStart,
                'km_end' => $kmEnd,
                'km_total' => $kmTotal,
                'estimated_km' => $this->calculateEstimatedKm($departure['lat'], $departure['lng'], $arrival['lat'], $arrival['lng']),
                'estimated_duration' => $durationMinutes,
                'route_type' => $faker->randomElement(['urbano', 'extraurbano', 'autostrada', 'misto']),
                'passengers_count' => $passengersCount,
                'passengers' => $passengers,
                'external_passengers' => $externalPassengers,
                'fuel_liters' => $fuelLiters,
                'fuel_cost' => $fuelCost,
                'toll_cost' => $tollCost,
                'parking_cost' => $parkingCost,
                'other_costs' => $otherCosts,
                'cost_notes' => $otherCosts ? $faker->randomElement(['Rifornimento AdBlue', 'Lavaggio veicolo', 'Kit emergenza', 'Materiale ufficio']) : null,
                'mission_order' => $faker->boolean(60) ? sprintf('OM-%s-%04d', date('Y'), rand(1, 9999)) : null,
                'notes' => $notes,
                'incidents' => $faker->boolean(5) ? $faker->randomElement(['Foratura pneumatico riparata', 'Piccolo graffio parcheggio', 'Spia motore accesa temporaneamente']) : null,
                'requires_overnight' => $requiresOvernight,
                'overnight_location' => $overnightLocation,
                'vehicle_check_before' => $vehicleCheckBefore,
                'vehicle_check_after' => $vehicleCheckAfter,
                'vehicle_damages' => $faker->boolean(3) ? $faker->randomElement(['Graffio portiera posteriore dx', 'Ammaccatura paraurti anteriore', 'Specchietto retrovisore dx danneggiato']) : null,
                'created_by' => $requester->id,
                'updated_by' => $status !== 'pending' ? $users->random()->id : $requester->id,
                'created_at' => $departureDatetime->copy()->subDays(rand(1, 7)),
                'updated_at' => $status === 'completed' ? $actualArrival : Carbon::now(),
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('Creati 150 movimenti di esempio!');

        // Mostra statistiche
        $this->command->table(
            ['Stato', 'Conteggio'],
            Movement::selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->get()
                ->map(fn($row) => [$row->status, $row->count])
                ->toArray()
        );
    }

    /**
     * Calcola distanza stimata in km tra due coordinate (formula haversine semplificata)
     */
    private function calculateEstimatedKm($lat1, $lng1, $lat2, $lng2): int
    {
        $earthRadius = 6371; // Raggio della Terra in km

        $latDiff = deg2rad($lat2 - $lat1);
        $lngDiff = deg2rad($lng2 - $lng1);

        $a = sin($latDiff/2) * sin($latDiff/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lngDiff/2) * sin($lngDiff/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c;

        // Aggiungi 20% per strade reali vs linea retta
        return round($distance * 1.2);
    }
}
