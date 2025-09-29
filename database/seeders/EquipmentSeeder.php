<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
            ['name' => 'Lampeggianti blu', 'description' => 'Barra luminosa principale', 'category' => 'emergency'],
            ['name' => 'Sirena bitonale', 'description' => 'Sistema acustico di emergenza', 'category' => 'emergency'],
            ['name' => 'Radio TETRA', 'description' => 'Sistema radio digitale', 'category' => 'communications'],
            ['name' => 'Tablet MDT', 'description' => 'Mobile Data Terminal', 'category' => 'communications'],
            ['name' => 'Gabbia posteriore', 'description' => 'Divisorio di sicurezza', 'category' => 'security'],
            ['name' => 'Dash cam', 'description' => 'Telecamera frontale HD', 'category' => 'emergency'],
            ['name' => 'Blindatura leggera', 'description' => 'Protezione balistica B4', 'category' => 'security'],
            ['name' => 'Vetri antiproiettile', 'description' => 'Livello BR4', 'category' => 'security'],
            ['name' => 'Run-flat pneumatici', 'description' => 'Pneumatici antiforatura', 'category' => 'security'],
            ['name' => 'Defibrillatore DAE', 'description' => 'Dispositivo salvavita', 'category' => 'medical'],
            ['name' => 'Monitor parametri vitali', 'description' => 'Sistema di monitoraggio', 'category' => 'medical'],
            ['name' => 'Bombola ossigeno', 'description' => 'Sistema ossigenoterapia', 'category' => 'medical'],
            ['name' => 'Barella pieghevole', 'description' => 'Barella autocaricante', 'category' => 'medical'],
            ['name' => 'Frigorifero farmaci', 'description' => 'Conservazione medicinali', 'category' => 'medical'],
            ['name' => 'Inverter 220V', 'description' => 'Alimentazione apparecchiature', 'category' => 'special'],
            ['name' => 'Estintore', 'description' => '2kg polvere ABC', 'category' => 'operational'],
            ['name' => 'Kit primo soccorso', 'description' => 'Conforme DM 388/03', 'category' => 'medical'],
            ['name' => 'Coni segnalazione', 'description' => 'Set 4 pezzi rifrangenti', 'category' => 'operational'],
            ['name' => 'Torce LED', 'description' => 'Ricaricabili USB', 'category' => 'operational'],
            ['name' => 'Sistema GPS', 'description' => 'Localizzazione satellitare', 'category' => 'communications'],
            ['name' => 'Telefono satellitare', 'description' => 'Comunicazioni sicure', 'category' => 'communications'],
            ['name' => 'Sirena Priority', 'description' => 'Sistema discreto', 'category' => 'emergency'],
            ['name' => 'Vetri oscurati', 'description' => 'Privacy protection', 'category' => 'security'],
            ['name' => 'Gancio traino', 'description' => 'Capacità 3500kg', 'category' => 'special'],
            ['name' => 'Barra antincastro', 'description' => 'Protezione posteriore', 'category' => 'special'],
            [
                'name' => 'Fari di profondità', 'description' => 'Illuminazione supplementare',
                'category' => 'operational'
            ],
            ['name' => 'Portapacchi', 'description' => 'Sistema modulare', 'category' => 'special'],
            ['name' => 'Compressore aria', 'description' => 'Portatile 12V', 'category' => 'operational'],
            ['name' => 'Kit attrezzi', 'description' => 'Set professionale', 'category' => 'operational'],
        ];


        foreach ($equipments as $equipment) {
            Equipment::create([
                'name' => $equipment['name'],
                'description' => $equipment['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}
