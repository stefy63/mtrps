<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarType;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carTypes = [
            [
                'name' => 'Berlina',
                'description' => 'Autovettura a 4 porte con bagagliaio separato',
                'note' => 'Ideale per trasporto persone e servizi di rappresentanza'
            ],
            [
                'name' => 'SUV',
                'description' => 'Sport Utility Vehicle - Veicolo ad alta altezza da terra',
                'note' => 'Adatto per terreni difficili e trasporto misto'
            ],
            [
                'name' => 'Station Wagon',
                'description' => 'Autovettura con bagagliaio esteso',
                'note' => 'Maggiore capacità di carico rispetto alle berline'
            ],
            [
                'name' => 'Furgone',
                'description' => 'Veicolo commerciale per trasporto merci',
                'note' => 'Utilizzato per trasporti e servizi tecnici'
            ],
            [
                'name' => 'Autobus',
                'description' => 'Veicolo per trasporto pubblico di persone',
                'note' => 'Per servizi di trasporto collettivo'
            ],
            [
                'name' => 'Motocicletta',
                'description' => 'Veicolo a due ruote motorizzato',
                'note' => 'Per servizi rapidi e pattugliamento'
            ],
            [
                'name' => 'Scooter',
                'description' => 'Motoveicolo di piccola cilindrata',
                'note' => 'Per servizi urbani e messaggistica'
            ],
            [
                'name' => 'Autocarro',
                'description' => 'Veicolo pesante per trasporto merci',
                'note' => 'Per trasporti di materiali e attrezzature pesanti'
            ],
            [
                'name' => 'Pickup',
                'description' => 'Veicolo con cassone posteriore aperto',
                'note' => 'Versatile per trasporto misto persone/materiali'
            ],
            [
                'name' => 'Utilitaria',
                'description' => 'Autovettura di piccole dimensioni',
                'note' => 'Economica per servizi urbani di base'
            ]
        ];

        foreach ($carTypes as $carType) {
            CarType::create($carType);
        }
    }
}

// Per eseguire il seeder:
// php artisan db:seed --class=CarTypeSeeder