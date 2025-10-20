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
            ['name' => 'Telepass', 'description' => 'Telepass'],
            ['name' => 'Radio TETRA', 'description' => 'Sistema radio digitale'],
            ['name' => 'Tablet MDT', 'description' => 'Mobile Data Terminal'],
            ['name' => 'Estintore', 'description' => '2kg polvere ABC'],
            ['name' => 'Kit primo soccorso', 'description' => 'Conforme DM 388/03'],
            ['name' => 'Fuel Card IP', 'description' => 'Carta carburante IP'],
            ['name' => 'Fuel Card Q8', 'description' => 'Carta carburante Q8'],
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
