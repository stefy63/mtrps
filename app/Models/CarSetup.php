<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CarSetup
 *
 * @property $id
 * @property $car_id
 * @property $name
 * @property $description
 * @property $date_from
 * @property $date_to
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property Car $car
 * @package App
 * @mixin Builder
 */
class CarSetup extends Model
{
    use SoftDeletes;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'name',
        'description',
        'date_from',
        'date_to',
        'note'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_from' => 'date:Y-m-d',
        'date_to' => 'date:Y-m-d',
    ];

    /**
     * Categorie predefinite di setup
     */
    const SETUP_CATEGORIES = [
        'SICUREZZA' => [
            'name' => 'Sicurezza e Protezione',
            'icon' => 'shield-check',
            'color' => 'danger',
            'examples' => [
                'Blindatura leggera B4',
                'Blindatura pesante B6/B7',
                'Vetri antiproiettile',
                'Sistema run-flat pneumatici',
                'Protezione sottoscocca IED',
                'Jammers anti-esplosivo'
            ]
        ],
        'COMUNICAZIONE' => [
            'name' => 'Comunicazioni',
            'icon' => 'broadcast',
            'color' => 'info',
            'examples' => [
                'Radio TETRA/DMR',
                'Ponte radio mobile',
                'Sistema satellitare BGAN',
                'Antenna HF/VHF/UHF',
                'Router 5G con ridondanza',
                'Centralino VoIP integrato'
            ]
        ],
        'EMERGENZA' => [
            'name' => 'Emergenza e Soccorso',
            'icon' => 'truck-medical',
            'color' => 'warning',
            'examples' => [
                'Kit medicale avanzato',
                'Defibrillatore DAE',
                'Barella e immobilizzatori',
                'Sistema ossigeno portatile',
                'Equipaggiamento NBCR',
                'Kit antincendio completo'
            ]
        ],
        'OPERATIVO' => [
            'name' => 'Allestimento Operativo',
            'icon' => 'cog',
            'color' => 'primary',
            'examples' => [
                'Scrivania mobile',
                'Postazione comando mobile',
                'Sistema videosorveglianza 360°',
                'Generatore ausiliario',
                'Inverter 220V potenza elevata',
                'Compressore aria integrato'
            ]
        ],
        'SPECIALE' => [
            'name' => 'Usi Speciali',
            'icon' => 'star',
            'color' => 'secondary',
            'examples' => [
                'Laboratorio mobile analisi',
                'Cinema/biblioteca mobile',
                'Ufficio anagrafe mobile',
                'Sportello pubblico mobile',
                'Aula formazione mobile',
                'Cucina da campo'
            ]
        ],
        'TRASPORTO' => [
            'name' => 'Trasporto Speciale',
            'icon' => 'people-carry-box',
            'color' => 'success',
            'examples' => [
                'Trasporto detenuti',
                'Trasporto valori',
                'Trasporto disabili',
                'Trasporto VIP/autorità',
                'Trasporto materiali sensibili',
                'Cella frigorifera'
            ]
        ],
        'TECNOLOGIA' => [
            'name' => 'Tecnologia Avanzata',
            'icon' => 'microchip',
            'color' => 'purple',
            'examples' => [
                'Drone con docking station',
                'Scanner biometrico',
                'Lettore targa ANPR mobile',
                'Sistema LIDAR/RADAR',
                'Termocamera FLIR',
                'Analizzatore spettro RF'
            ]
        ]
    ];

    /**
     * @return BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Scope per setup attivi
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->whereNull('date_to')
              ->orWhere('date_to', '>=', now());
        });
    }

    /**
     * Scope per setup in un periodo specifico
     */
    public function scopeInPeriod(Builder $query, $dateFrom, $dateTo = null): Builder
    {
        return $query->where(function ($q) use ($dateFrom, $dateTo) {
            // Se dateTo non è specificato, cerca setup attivi in quella data
            if (is_null($dateTo)) {
                $q->where('date_from', '<=', $dateFrom)
                  ->where(function ($q2) use ($dateFrom) {
                      $q2->whereNull('date_to')
                         ->orWhere('date_to', '>=', $dateFrom);
                  });
            } else {
                // Altrimenti cerca sovrapposizioni con il periodo
                $q->where(function ($q2) use ($dateFrom, $dateTo) {
                    $q2->whereBetween('date_from', [$dateFrom, $dateTo])
                       ->orWhereBetween('date_to', [$dateFrom, $dateTo])
                       ->orWhere(function ($q3) use ($dateFrom, $dateTo) {
                           $q3->where('date_from', '<=', $dateFrom)
                              ->where(function ($q4) use ($dateTo) {
                                  $q4->where('date_to', '>=', $dateTo)
                                     ->orWhereNull('date_to');
                              });
                       });
                });
            }
        });
    }

    /**
     * Scope per categoria
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        $examples = self::SETUP_CATEGORIES[$category]['examples'] ?? [];

        return $query->where(function ($q) use ($examples) {
            foreach ($examples as $example) {
                $q->orWhere('name', 'LIKE', '%' . $example . '%');
            }
        });
    }

    /**
     * Verifica se è attivo
     */
    public function getIsActiveAttribute(): bool
    {
        return is_null($this->date_to) || $this->date_to >= now();
    }

    /**
     * Ottieni la durata in giorni
     */
    public function getDurationDaysAttribute(): ?int
    {
        if (!$this->date_from) {
            return null;
        }

        $endDate = $this->date_to ?? now();
        return Carbon::parse($this->date_from)->diffInDays($endDate);
    }

    /**
     * Ottieni la categoria del setup
     */
    public function getCategoryAttribute(): ?string
    {
        foreach (self::SETUP_CATEGORIES as $key => $category) {
            foreach ($category['examples'] as $example) {
                if (stripos($this->name, $example) !== false) {
                    return $key;
                }
            }
        }
        return null;
    }

    /**
     * Ottieni informazioni sulla categoria
     */
    public function getCategoryInfoAttribute(): ?array
    {
        $category = $this->category;
        return $category ? self::SETUP_CATEGORIES[$category] : null;
    }

    /**
     * Formatta il periodo
     */
    public function getFormattedPeriodAttribute(): string
    {
        $from = $this->date_from ? Carbon::parse($this->date_from)->format('d/m/Y') : '';
        $to = $this->date_to ? Carbon::parse($this->date_to)->format('d/m/Y') : 'Attivo';

        return $from . ' - ' . $to;
    }

    /**
     * Ottieni tutti i setup per tipo di veicolo
     */
    public static function getSetupsByCarType($carTypeId)
    {
        return self::whereHas('car', function ($query) use ($carTypeId) {
            $query->where('car_type_id', $carTypeId);
        })->get();
    }

    /**
     * Suggerimenti basati sul tipo di veicolo
     */
    public static function getSuggestionsByCarType($carTypeId): array
    {
        $suggestions = [];

        // Mapping tipo veicolo -> categorie consigliate
        $typeMapping = [
            'berlina' => ['SICUREZZA', 'COMUNICAZIONE', 'TRASPORTO'],
            'suv' => ['SICUREZZA', 'OPERATIVO', 'TECNOLOGIA'],
            'furgone' => ['OPERATIVO', 'SPECIALE', 'TRASPORTO'],
            'ambulanza' => ['EMERGENZA', 'COMUNICAZIONE', 'TECNOLOGIA'],
            'pickup' => ['OPERATIVO', 'EMERGENZA', 'TECNOLOGIA'],
            'autobus' => ['TRASPORTO', 'SPECIALE', 'COMUNICAZIONE'],
            'moto' => ['COMUNICAZIONE', 'SICUREZZA', 'TECNOLOGIA']
        ];

        // Ottieni il tipo di veicolo
        $carType = \App\Models\CarType::find($carTypeId);
        if (!$carType) {
            return $suggestions;
        }

        $typeName = strtolower($carType->name);
        $recommendedCategories = [];

        foreach ($typeMapping as $type => $categories) {
            if (stripos($typeName, $type) !== false) {
                $recommendedCategories = array_merge($recommendedCategories, $categories);
            }
        }

        // Se non ci sono categorie specifiche, suggerisci quelle più comuni
        if (empty($recommendedCategories)) {
            $recommendedCategories = ['OPERATIVO', 'COMUNICAZIONE', 'SICUREZZA'];
        }

        // Costruisci i suggerimenti
        foreach (array_unique($recommendedCategories) as $categoryKey) {
            if (isset(self::SETUP_CATEGORIES[$categoryKey])) {
                $category = self::SETUP_CATEGORIES[$categoryKey];
                foreach ($category['examples'] as $example) {
                    $suggestions[] = [
                        'name' => $example,
                        'category' => $categoryKey,
                        'category_name' => $category['name'],
                        'icon' => $category['icon'],
                        'color' => $category['color']
                    ];
                }
            }
        }

        return $suggestions;
    }

    /**
     * Verifica conflitti di setup
     */
    public function hasConflicts(): bool
    {
        return self::where('car_id', $this->car_id)
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                // Stesso nome di setup nello stesso periodo
                $query->where('name', $this->name)
                      ->inPeriod($this->date_from, $this->date_to);
            })
            ->exists();
    }
}
