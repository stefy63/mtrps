<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarEquipment;
use App\Models\Car;
use Carbon\Carbon;

class CarEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recupera tutti i veicoli
        $cars = Car::with('carType')->get();

        if ($cars->isEmpty()) {
            $this->command->warn('Nessun veicolo trovato. Esegui prima CarSeeder.');
            return;
        }

        $equipmentCount = 0;

        foreach ($cars as $car) {
            $carType = strtolower($car->carType->name ?? '');
            $carName = strtolower($car->name);

            // Determina gli equipaggiamenti in base al tipo di veicolo
            $equipments = [];

            // Veicoli di servizio/emergenza
            if (str_contains($carType, 'polizia') || str_contains($carType, 'carabinier') ||
                str_contains($carName, 'alfa') || str_contains($carName, 'pantere')) {
                $equipments = [
                    ['name' => 'Lampeggianti blu', 'description' => 'Barra luminosa principale', 'category' => 'emergency'],
                    ['name' => 'Sirena bitonale', 'description' => 'Sistema acustico di emergenza', 'category' => 'emergency'],
                    ['name' => 'Radio TETRA', 'description' => 'Sistema radio digitale', 'category' => 'communications'],
                    ['name' => 'Tablet MDT', 'description' => 'Mobile Data Terminal', 'category' => 'communications'],
                    ['name' => 'Gabbia posteriore', 'description' => 'Divisorio di sicurezza', 'category' => 'security'],
                    ['name' => 'Dash cam', 'description' => 'Telecamera frontale HD', 'category' => 'emergency'],
                ];

                // Aggiungi blindatura per veicoli speciali
                if (str_contains($carName, 'blindat')) {
                    $equipments[] = ['name' => 'Blindatura leggera', 'description' => 'Protezione balistica B4', 'category' => 'security'];
                    $equipments[] = ['name' => 'Vetri antiproiettile', 'description' => 'Livello BR4', 'category' => 'security'];
                    $equipments[] = ['name' => 'Run-flat pneumatici', 'description' => 'Pneumatici antiforatura', 'category' => 'security'];
                }
            }

            // Ambulanze
            elseif (str_contains($carType, 'ambulanz')) {
                $equipments = [
                    ['name' => 'Lampeggianti blu', 'description' => 'Sistema luminoso di emergenza', 'category' => 'emergency'],
                    ['name' => 'Sirena elettronica', 'description' => 'Multi-tono programmabile', 'category' => 'emergency'],
                    ['name' => 'Radio VHF', 'description' => 'Comunicazioni sanitarie', 'category' => 'communications'],
                    ['name' => 'Defibrillatore DAE', 'description' => 'Dispositivo salvavita', 'category' => 'medical'],
                    ['name' => 'Monitor parametri vitali', 'description' => 'Sistema di monitoraggio', 'category' => 'medical'],
                    ['name' => 'Bombola ossigeno', 'description' => 'Sistema ossigenoterapia', 'category' => 'medical'],
                    ['name' => 'Barella pieghevole', 'description' => 'Barella autocaricante', 'category' => 'medical'],
                    ['name' => 'Frigorifero farmaci', 'description' => 'Conservazione medicinali', 'category' => 'medical'],
                    ['name' => 'Inverter 220V', 'description' => 'Alimentazione apparecchiature', 'category' => 'special'],
                ];
            }

            // Veicoli ministeriali/rappresentanza
            elseif (str_contains($carType, 'berlin') || str_contains($carType, 'rappresentanza') ||
                   str_contains($carName, 'minister')) {
                $equipments = [
                    ['name' => 'Lampeggianti blu', 'description' => 'Dispositivi retrattili', 'category' => 'emergency'],
                    ['name' => 'Sirena Priority', 'description' => 'Sistema discreto', 'category' => 'emergency'],
                    ['name' => 'Blindatura leggera', 'description' => 'Protezione VIP', 'category' => 'security'],
                    ['name' => 'Vetri oscurati', 'description' => 'Privacy protection', 'category' => 'security'],
                    ['name' => 'Sistema GPS', 'description' => 'Localizzazione satellitare', 'category' => 'communications'],
                    ['name' => 'Telefono satellitare', 'description' => 'Comunicazioni sicure', 'category' => 'communications'],
                ];
            }

            // Furgoni/veicoli operativi
            elseif (str_contains($carType, 'furgon') || str_contains($carType, 'pickup')) {
                $equipments = [
                    ['name' => 'Gancio traino', 'description' => 'Capacità 3500kg', 'category' => 'special'],
                    ['name' => 'Barra antincastro', 'description' => 'Protezione posteriore', 'category' => 'special'],
                    ['name' => 'Fari di profondità', 'description' => 'Illuminazione supplementare', 'category' => 'operational'],
                    ['name' => 'Portapacchi', 'description' => 'Sistema modulare', 'category' => 'special'],
                    ['name' => 'Compressore aria', 'description' => 'Portatile 12V', 'category' => 'operational'],
                    ['name' => 'Kit attrezzi', 'description' => 'Set professionale', 'category' => 'operational'],
                ];
            }

            // Veicoli standard (tutti hanno equipaggiamenti base)
            $baseEquipments = [
                ['name' => 'Estintore', 'description' => '2kg polvere ABC', 'category' => 'operational'],
                ['name' => 'Kit primo soccorso', 'description' => 'Conforme DM 388/03', 'category' => 'medical'],
                ['name' => 'Coni segnalazione', 'description' => 'Set 4 pezzi rifrangenti', 'category' => 'operational'],
                ['name' => 'Torce LED', 'description' => 'Ricaricabili USB', 'category' => 'operational'],
            ];

            // Aggiungi equipaggiamenti base a tutti
            $equipments = array_merge($equipments, $baseEquipments);

            // Rimuovi duplicati
            $equipments = array_unique($equipments, SORT_REGULAR);

            // Crea gli equipaggiamenti per questo veicolo
            foreach ($equipments as $equipment) {
                // Determina date casuali
                $installDate = Carbon::now()->subDays(rand(30, 730)); // Ultimi 2 anni
                $removeDate = null;

                // 30% di probabilità che sia stato rimosso
                if (rand(1, 100) <= 30) {
                    $daysInstalled = rand(30, 365);
                    $removeDate = $installDate->copy()->addDays($daysInstalled);

                    // Non può essere rimosso nel futuro
                    if ($removeDate->isFuture()) {
                        $removeDate = null;
                    }
                }

                // Note casuali
                $notes = [
                    null,
                    null,
                    null, // Più probabilità di non avere note
                    'Installazione originale di fabbrica',
                    'Retrofit su richiesta',
                    'Sostituzione componente precedente',
                    'Upgrade sistema precedente',
                    'Manutenzione programmata ogni 6 mesi',
                    'Certificazione in corso',
                    'Garanzia fino al ' . Carbon::now()->addMonths(rand(6, 24))->format('m/Y'),
                    'Numero seriale: ' . strtoupper(substr(md5(rand()), 0, 8)),
                ];

                CarEquipment::create([
                    'car_id' => $car->id,
                    'name' => $equipment['name'],
                    'description' => $equipment['description'],
                    'date_from' => $installDate,
                    'date_to' => $removeDate,
                    'note' => $notes[array_rand($notes)],
                ]);

                $equipmentCount++;
            }
        }

        $this->command->info("Creati {$equipmentCount} equipaggiamenti per " . $cars->count() . " veicoli.");
    }
}
