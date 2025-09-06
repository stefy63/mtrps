<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssigneeOffice;
use App\Models\CarAssignee;

class AssigneeOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officeTemplates = [
            // Ministeri
            'ministero' => [
                ['name' => 'Ufficio di Gabinetto', 'description' => 'Supporto diretto al Ministro'],
                ['name' => 'Segreteria Generale', 'description' => 'Coordinamento generale del Ministero'],
                ['name' => 'Segreteria Particolare', 'description' => 'Segreteria personale del Ministro'],
                ['name' => 'Ufficio Legislativo', 'description' => 'Elaborazione normative e decreti'],
                ['name' => 'Ufficio Stampa', 'description' => 'Relazioni con i media'],
                ['name' => 'Direzione Generale del Personale', 'description' => 'Gestione risorse umane'],
                ['name' => 'Direzione Generale Bilancio', 'description' => 'Gestione economico-finanziaria'],
                ['name' => 'Servizio Ispettivo', 'description' => 'Controlli e ispezioni'],
            ],

            // Forze dell'Ordine - Carabinieri
            'carabinieri' => [
                ['name' => 'Comando Provinciale', 'description' => 'Comando territoriale provinciale'],
                ['name' => 'Compagnia', 'description' => 'Comando di compagnia territoriale'],
                ['name' => 'Nucleo Operativo', 'description' => 'Investigazioni e operazioni'],
                ['name' => 'Nucleo Radiomobile', 'description' => 'Pronto intervento e pattugliamento'],
                ['name' => 'Stazione', 'description' => 'Presidio territoriale di base'],
                ['name' => 'Nucleo Investigativo', 'description' => 'Indagini complesse'],
                ['name' => 'Nucleo Antisofisticazioni', 'description' => 'Controlli sanitari e alimentari'],
                ['name' => 'Nucleo Ecologico', 'description' => 'Tutela ambientale'],
            ],

            // Forze dell'Ordine - Polizia
            'polizia' => [
                ['name' => 'Questura', 'description' => 'Comando provinciale Polizia di Stato'],
                ['name' => 'Squadra Mobile', 'description' => 'Investigazioni giudiziarie'],
                ['name' => 'Squadra Volante', 'description' => 'Pronto intervento'],
                ['name' => 'DIGOS', 'description' => 'Divisione Investigazioni Generali'],
                ['name' => 'Polizia Stradale', 'description' => 'Sicurezza stradale e autostradale'],
                ['name' => 'Polizia Postale', 'description' => 'Crimini informatici e telematici'],
                ['name' => 'Reparto Mobile', 'description' => 'Ordine pubblico'],
                ['name' => 'Commissariato', 'description' => 'Presidio territoriale'],
            ],

            // Comuni
            'comune' => [
                ['name' => 'Ufficio del Sindaco', 'description' => 'Staff del primo cittadino'],
                ['name' => 'Segreteria Generale', 'description' => 'Coordinamento amministrativo'],
                ['name' => 'Assessorato Mobilità', 'description' => 'Trasporti e viabilità'],
                ['name' => 'Area Tecnica', 'description' => 'Servizi tecnici comunali'],
                ['name' => 'Settore Lavori Pubblici', 'description' => 'Gestione opere pubbliche'],
                ['name' => 'Polizia Municipale', 'description' => 'Polizia locale'],
                ['name' => 'Protezione Civile', 'description' => 'Emergenze e calamità'],
                ['name' => 'Servizi Sociali', 'description' => 'Assistenza sociale'],
            ],

            // Regioni
            'regione' => [
                ['name' => 'Ufficio del Presidente', 'description' => 'Presidenza della Regione'],
                ['name' => 'Assessorato Trasporti', 'description' => 'Mobilità regionale'],
                ['name' => 'Direzione Generale', 'description' => 'Coordinamento regionale'],
                ['name' => 'Settore Ambiente', 'description' => 'Tutela ambientale'],
                ['name' => 'Settore Sanità', 'description' => 'Servizi sanitari regionali'],
                ['name' => 'Settore Formazione', 'description' => 'Formazione professionale'],
                ['name' => 'Ufficio Europa', 'description' => 'Fondi e progetti europei'],
                ['name' => 'Avvocatura Regionale', 'description' => 'Servizi legali'],
            ],
        ];

        // Recupera tutti gli assegnatari
        $assignees = CarAssignee::all();

        if ($assignees->isEmpty()) {
            $this->command->warn('Nessun assegnatario trovato. Esegui prima CarAssigneeSeeder.');
            return;
        }

        foreach ($assignees as $assignee) {
            // Determina il tipo di ente basandosi sul nome dell'assegnatario
            $assigneeName = strtolower($assignee->name);

            if (str_contains($assigneeName, 'ministero') || str_contains($assigneeName, 'ministro')) {
                $offices = $officeTemplates['ministero'];
                $numOffices = rand(2, 4);
            } elseif (str_contains($assigneeName, 'comando') || str_contains($assigneeName, 'compagnia') ||
                     str_contains($assigneeName, 'nucleo') || str_contains($assigneeName, 'carabinier')) {
                $offices = $officeTemplates['carabinieri'];
                $numOffices = rand(1, 3);
            } elseif (str_contains($assigneeName, 'questura') || str_contains($assigneeName, 'commissariato') ||
                     str_contains($assigneeName, 'squadra') || str_contains($assigneeName, 'polizi')) {
                $offices = $officeTemplates['polizia'];
                $numOffices = rand(1, 3);
            } elseif (str_contains($assigneeName, 'comune') || str_contains($assigneeName, 'sindaco') ||
                     str_contains($assigneeName, 'municipal')) {
                $offices = $officeTemplates['comune'];
                $numOffices = rand(2, 4);
            } elseif (str_contains($assigneeName, 'regione') || str_contains($assigneeName, 'regional') ||
                     str_contains($assigneeName, 'presidente')) {
                $offices = $officeTemplates['regione'];
                $numOffices = rand(2, 3);
            } else {
                // Uffici generici per altri enti
                $offices = [
                    ['name' => 'Direzione Generale', 'description' => 'Coordinamento generale'],
                    ['name' => 'Ufficio Tecnico', 'description' => 'Servizi tecnici'],
                    ['name' => 'Ufficio Amministrativo', 'description' => 'Servizi amministrativi'],
                    ['name' => 'Segreteria', 'description' => 'Supporto amministrativo'],
                ];
                $numOffices = rand(1, 2);
            }

            // Seleziona casualmente alcuni uffici
            $selectedOffices = array_rand($offices, min($numOffices, count($offices)));
            if (!is_array($selectedOffices)) {
                $selectedOffices = [$selectedOffices];
            }

            foreach ($selectedOffices as $index) {
                $office = $offices[$index];

                // Aggiungi note casuali
                $notes = [
                    null,
                    null, // Più probabilità di non avere note
                    'Ufficio di nuova costituzione',
                    'In fase di riorganizzazione',
                    'Sede principale',
                    'Sede distaccata',
                    'Orario: Lun-Ven 8:00-14:00',
                    'Ricevimento pubblico: Mar e Gio 9:00-12:00',
                    'Responsabile: Da nominare',
                    'Tel. interno: ' . rand(100, 999),
                ];

                AssigneeOffice::create([
                    'car_assignee_id' => $assignee->id,
                    'name' => $office['name'],
                    'description' => $office['description'],
                    'note' => $notes[array_rand($notes)],
                ]);
            }
        }

        $totalOffices = AssigneeOffice::count();
        $this->command->info("Creati {$totalOffices} uffici assegnatari.");
    }
}
