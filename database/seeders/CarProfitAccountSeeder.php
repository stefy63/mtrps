<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarProfitAccount;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CarProfitAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');

        // Centri di costo tipici per PA italiana
        $accounts = [
            [
                'code' => 'CEC0001',
                'name' => 'Direzione Generale',
                'category' => 'amministrativo',
                'department' => 'Direzione Generale',
                'responsible' => 'Dott. Mario Rossi',
                'email' => 'direzione@comune.it',
                'phone' => '+39 02 1234567',
                'budget_year' => 150000,
                'description' => 'Centro di costo per veicoli della Direzione Generale e rappresentanza',
            ],
            [
                'code' => 'POL0001',
                'name' => 'Polizia Locale - Pattuglie',
                'category' => 'operativo',
                'department' => 'Polizia Locale',
                'responsible' => 'Comm. Anna Verdi',
                'email' => 'comandante.pl@comune.it',
                'phone' => '+39 02 2345678',
                'budget_year' => 350000,
                'description' => 'Veicoli operativi per servizio di pattugliamento e controllo territorio',
            ],
            [
                'code' => 'POL0002',
                'name' => 'Polizia Locale - Comando',
                'category' => 'istituzionale',
                'department' => 'Polizia Locale',
                'responsible' => 'Comm. Anna Verdi',
                'email' => 'comandante.pl@comune.it',
                'phone' => '+39 02 2345678',
                'budget_year' => 50000,
                'description' => 'Veicoli di servizio per ufficiali e comando',
            ],
            [
                'code' => 'TEC0001',
                'name' => 'Ufficio Tecnico - Manutenzioni',
                'category' => 'operativo',
                'department' => 'Ufficio Tecnico',
                'responsible' => 'Ing. Giuseppe Bianchi',
                'email' => 'ufficio.tecnico@comune.it',
                'phone' => '+39 02 3456789',
                'budget_year' => 120000,
                'description' => 'Veicoli per manutenzione strade, verde pubblico e infrastrutture',
            ],
            [
                'code' => 'PC0001',
                'name' => 'Protezione Civile',
                'category' => 'emergenza',
                'department' => 'Protezione Civile',
                'responsible' => 'Dott. Luca Neri',
                'email' => 'protezione.civile@comune.it',
                'phone' => '+39 02 4567890',
                'budget_year' => 180000,
                'description' => 'Veicoli per emergenze e calamità naturali',
            ],
            [
                'code' => 'SOC0001',
                'name' => 'Servizi Sociali',
                'category' => 'operativo',
                'department' => 'Servizi Sociali',
                'responsible' => 'Dott.ssa Maria Gialli',
                'email' => 'servizi.sociali@comune.it',
                'phone' => '+39 02 5678901',
                'budget_year' => 80000,
                'description' => 'Veicoli per trasporto assistito e servizi alla persona',
            ],
            [
                'code' => 'AMM0001',
                'name' => 'Servizi Amministrativi',
                'category' => 'amministrativo',
                'department' => 'Servizi Amministrativi',
                'responsible' => 'Dott.ssa Paola Viola',
                'email' => 'amministrazione@comune.it',
                'phone' => '+39 02 6789012',
                'budget_year' => 60000,
                'description' => 'Veicoli per servizi amministrativi e consegne',
            ],
            [
                'code' => 'CUL0001',
                'name' => 'Cultura e Sport',
                'category' => 'operativo',
                'department' => 'Cultura e Sport',
                'responsible' => 'Dott. Marco Arancioni',
                'email' => 'cultura@comune.it',
                'phone' => '+39 02 7890123',
                'budget_year' => 40000,
                'description' => 'Veicoli per eventi culturali e manifestazioni sportive',
            ],
            [
                'code' => 'PRG0001',
                'name' => 'Progetti Speciali PNRR',
                'category' => 'progetti',
                'department' => 'Progetti Speciali',
                'responsible' => 'Ing. Laura Grigi',
                'email' => 'progetti.pnrr@comune.it',
                'phone' => '+39 02 8901234',
                'budget_year' => 200000,
                'description' => 'Centro di costo per veicoli progetti PNRR',
                'valid_from' => Carbon::now(),
                'valid_to' => Carbon::now()->addYears(3),
            ],
            [
                'code' => 'ECO0001',
                'name' => 'Economato',
                'category' => 'amministrativo',
                'department' => 'Economato',
                'responsible' => 'Rag. Franco Celesti',
                'email' => 'economato@comune.it',
                'phone' => '+39 02 9012345',
                'budget_year' => 30000,
                'description' => 'Veicoli per servizi economali e approvvigionamenti',
            ],
            [
                'code' => 'AMB0001',
                'name' => 'Ambiente e Territorio',
                'category' => 'operativo',
                'department' => 'Ambiente',
                'responsible' => 'Dott. Roberto Marroni',
                'email' => 'ambiente@comune.it',
                'phone' => '+39 02 0123456',
                'budget_year' => 90000,
                'description' => 'Veicoli per controlli ambientali e monitoraggio territorio',
            ],
            [
                'code' => 'MAN0001',
                'name' => 'Manutenzione Veicoli',
                'category' => 'manutenzione',
                'department' => 'Economato',
                'responsible' => 'Rag. Franco Celesti',
                'email' => 'economato@comune.it',
                'phone' => '+39 02 9012345',
                'budget_year' => 250000,
                'description' => 'Centro di costo dedicato alla manutenzione ordinaria e straordinaria del parco auto',
            ],
            [
                'code' => 'IST0001',
                'name' => 'Veicoli Istituzionali',
                'category' => 'istituzionale',
                'department' => 'Segreteria Generale',
                'responsible' => 'Dott.ssa Silvia Rosa',
                'email' => 'segreteria@comune.it',
                'phone' => '+39 02 1122334',
                'budget_year' => 100000,
                'description' => 'Veicoli per Sindaco, Assessori e rappresentanza istituzionale',
            ],
            [
                'code' => 'URB0001',
                'name' => 'Urbanistica',
                'category' => 'operativo',
                'department' => 'Urbanistica',
                'responsible' => 'Arch. Giovanni Azzurri',
                'email' => 'urbanistica@comune.it',
                'phone' => '+39 02 2233445',
                'budget_year' => 45000,
                'description' => 'Veicoli per sopralluoghi e controlli edilizi',
            ],
            [
                'code' => 'POOL001',
                'name' => 'Car Pooling Aziendale',
                'category' => 'operativo',
                'department' => 'Servizi Generali',
                'responsible' => 'Dott. Pietro Bianchi',
                'email' => 'carpool@comune.it',
                'phone' => '+39 02 3344556',
                'budget_year' => 70000,
                'description' => 'Veicoli condivisi per spostamenti del personale',
            ],
        ];

        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('Nessun utente trovato. Esegui prima UserSeeder.');
            return;
        }

        $this->command->info('Generazione centri di costo...');

        foreach ($accounts as $accountData) {
            // Aggiungi date casuali se non specificate
            if (!isset($accountData['valid_from'])) {
                $accountData['valid_from'] = $faker->boolean(70) ? Carbon::now()->subMonths(rand(1, 12)) : null;
            }

            if (!isset($accountData['valid_to'])) {
                if ($accountData['valid_from'] && $faker->boolean(40)) {
                    $accountData['valid_to'] = Carbon::now()->addMonths(rand(6, 36));
                } else {
                    $accountData['valid_to'] = null;
                }
            }

            // Calcola budget mensile
            $accountData['budget_month'] = round($accountData['budget_year'] / 12, 2);

            // Stato attivo (alcuni centri potrebbero essere inattivi)
            $accountData['is_active'] = $faker->boolean(90);

            // Note casuali
            if ($faker->boolean(30)) {
                $accountData['notes'] = $faker->randomElement([
                    'Centro di costo soggetto a revisione trimestrale',
                    'Budget incrementato del 10% per progetti straordinari',
                    'Verificare rendicontazione mensile entro il 5 del mese',
                    'Autorizzazione DG per spese superiori a 5000€',
                    'Centro di costo in fase di riorganizzazione',
                ]);
            }

            // Metadati
            $accountData['created_by'] = $users->random()->id;
            $accountData['updated_by'] = $faker->boolean(60) ? $users->random()->id : $accountData['created_by'];
            $accountData['created_at'] = Carbon::now()->subDays(rand(30, 365));
            $accountData['updated_at'] = $faker->boolean(70)
                ? Carbon::now()->subDays(rand(1, 29))
                : $accountData['created_at'];

            CarProfitAccount::create($accountData);
        }

        // Genera alcuni centri di costo scaduti per testing
        for ($i = 1; $i <= 3; $i++) {
            CarProfitAccount::create([
                'code' => 'OLD00' . $i,
                'name' => 'Centro Costo Scaduto ' . $i,
                'category' => $faker->randomElement(array_keys(CarProfitAccount::CATEGORIES)),
                'department' => 'Archivio',
                'description' => 'Centro di costo non più attivo',
                'budget_year' => rand(20000, 80000),
                'budget_month' => rand(1500, 6000),
                'is_active' => true,
                'valid_from' => Carbon::now()->subYears(3),
                'valid_to' => Carbon::now()->subMonths(rand(1, 6)),
                'created_by' => $users->random()->id,
                'updated_by' => $users->random()->id,
            ]);
        }

        $this->command->info('Creati ' . CarProfitAccount::count() . ' centri di costo!');

        // Mostra statistiche
        $this->command->table(
            ['Categoria', 'Conteggio'],
            CarProfitAccount::selectRaw('category, count(*) as count')
                ->groupBy('category')
                ->get()
                ->map(fn($row) => [
                    CarProfitAccount::CATEGORIES[$row->category] ?? $row->category ?? 'N/D',
                    $row->count
                ])
                ->toArray()
        );
    }
}
