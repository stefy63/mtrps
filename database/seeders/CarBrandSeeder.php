<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarBrand;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carBrands = [
            // Marche Italiane
            [
                'name' => 'Fiat',
                'description' => 'Casa automobilistica italiana fondata nel 1899',
                'note' => 'Marchio storico italiano, leader nel mercato delle utilitarie. Modelli popolari: Panda, 500, Punto, Tipo.'
            ],
            [
                'name' => 'Alfa Romeo',
                'description' => 'Marchio italiano premium di auto sportive',
                'note' => 'Tradizione sportiva italiana, design distintivo. Modelli: Giulia, Stelvio, Giulietta.'
            ],
            [
                'name' => 'Lancia',
                'description' => 'Marchio italiano di auto eleganti e innovative',
                'note' => 'Storico marchio italiano noto per innovazione e design raffinato. Modelli: Ypsilon, Delta.'
            ],
            
            // Marche Tedesche
            [
                'name' => 'BMW',
                'description' => 'Casa automobilistica tedesca premium',
                'note' => 'Marchio tedesco di lusso, motori performanti e tecnologia avanzata. Serie 1, 3, 5, 7, X1, X3, X5.'
            ],
            [
                'name' => 'Mercedes-Benz',
                'description' => 'Marchio tedesco di auto di lusso e commerciali',
                'note' => 'Simbolo di lusso e qualità tedesca. Classe A, C, E, S, GLA, GLC, Sprinter.'
            ],
            [
                'name' => 'Audi',
                'description' => 'Casa automobilistica tedesca del gruppo Volkswagen',
                'note' => 'Tecnologia Quattro, design moderno. A1, A3, A4, A6, Q3, Q5, Q7.'
            ],
            [
                'name' => 'Volkswagen',
                'description' => 'Maggiore casa automobilistica tedesca',
                'note' => 'Affidabilità e qualità tedesca. Golf, Polo, Passat, Tiguan, Touran.'
            ],
            [
                'name' => 'Opel',
                'description' => 'Marchio tedesco ora del gruppo Stellantis',
                'note' => 'Auto pratiche e accessibili. Corsa, Astra, Insignia, Crossland.'
            ],
            
            // Marche Francesi
            [
                'name' => 'Peugeot',
                'description' => 'Casa automobilistica francese del gruppo Stellantis',
                'note' => 'Design francese distintivo, comfort di guida. 208, 308, 3008, 5008.'
            ],
            [
                'name' => 'Citroën',
                'description' => 'Marchio francese noto per comfort e innovazione',
                'note' => 'Sospensioni innovative, design originale. C1, C3, C4, C5 Aircross.'
            ],
            [
                'name' => 'Renault',
                'description' => 'Casa automobilistica francese',
                'note' => 'Innovazione e praticità francese. Clio, Megane, Captur, Kadjar.'
            ],
            
            // Marche Giapponesi
            [
                'name' => 'Toyota',
                'description' => 'Casa automobilistica giapponese leader mondiale',
                'note' => 'Affidabilità leggendaria, tecnologia ibrida. Yaris, Corolla, Prius, RAV4.'
            ],
            [
                'name' => 'Honda',
                'description' => 'Marchio giapponese noto per affidabilità',
                'note' => 'Motori efficienti e durevoli. Civic, Accord, CR-V, HR-V.'
            ],
            [
                'name' => 'Nissan',
                'description' => 'Casa automobilistica giapponese',
                'note' => 'Innovazione e tecnologia giapponese. Micra, Qashqai, X-Trail, Leaf (elettrica).'
            ],
            
            // Marche Americane
            [
                'name' => 'Ford',
                'description' => 'Storica casa automobilistica americana',
                'note' => 'Tradizione americana, veicoli robusti. Fiesta, Focus, Kuga, Ranger.'
            ],
            [
                'name' => 'Jeep',
                'description' => 'Marchio americano specializzato in SUV',
                'note' => 'Leader nei SUV e fuoristrada. Renegade, Compass, Cherokee, Wrangler.'
            ],
            
            // Marche Coreane
            [
                'name' => 'Hyundai',
                'description' => 'Casa automobilistica sudcoreana',
                'note' => 'Rapporto qualità-prezzo eccellente, garanzia estesa. i10, i20, i30, Tucson.'
            ],
            [
                'name' => 'Kia',
                'description' => 'Marchio sudcoreano del gruppo Hyundai',
                'note' => 'Design moderno, tecnologia avanzata. Picanto, Rio, Ceed, Sportage.'
            ],
            
            // Altre marche
            [
                'name' => 'Volvo',
                'description' => 'Casa automobilistica svedese, ora cinese',
                'note' => 'Sicurezza e sostenibilità. XC40, XC60, XC90, V60.'
            ],
            [
                'name' => 'SEAT',
                'description' => 'Marchio spagnolo del gruppo Volkswagen',
                'note' => 'Design sportivo e giovane. Ibiza, Leon, Arona, Ateca.'
            ]
        ];

        foreach ($carBrands as $carBrand) {
            CarBrand::create($carBrand);
        }
    }
}

// Per eseguire il seeder:
// php artisan db:seed --class=CarBrandSeeder
