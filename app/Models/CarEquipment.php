<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class CarEquipment
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
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarEquipment extends Model
{
    protected $table = 'car_equipment';

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['car_id', 'name', 'description', 'date_from', 'date_to', 'note'];

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['is_active', 'duration_days', 'status_badge'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class);
    }

    /**
     * Verifica se l'equipaggiamento è attualmente installato
     *
     * @return bool
     */
    public function getIsActiveAttribute(): bool
    {
        return $this->date_to === null || $this->date_to >= now();
    }

    /**
     * Calcola la durata in giorni
     *
     * @return int|null
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
     * Badge HTML per lo stato
     *
     * @return string
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->is_active) {
            return '<span class="badge bg-success">Installato</span>';
        } else {
            return '<span class="badge bg-secondary">Rimosso</span>';
        }
    }

    /**
     * Scope per equipaggiamenti attivi
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->whereNull('date_to')
              ->orWhere('date_to', '>=', now());
        });
    }

    /**
     * Scope per equipaggiamenti inattivi
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->whereNotNull('date_to')
                     ->where('date_to', '<', now());
    }

    /**
     * Scope per ricerca
     *
     * @param Builder $query
     * @param string $search
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhereHas('car', function ($query) use ($search) {
                  $query->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('car.carPlates', function ($query) use ($search) {
                  $query->where('name', 'like', "%{$search}%");
              });
        });
    }

    /**
     * Scope per veicolo
     *
     * @param Builder $query
     * @param int $carId
     * @return Builder
     */
    public function scopeForCar(Builder $query, int $carId): Builder
    {
        return $query->where('car_id', $carId);
    }

    /**
     * Lista equipaggiamenti tipici per tipo di veicolo
     *
     * @return array
     */
    public static function getTypicalEquipments(): array
    {
        return [
            // Equipaggiamenti di emergenza
            'emergency' => [
                'Lampeggianti blu',
                'Sirena bitonale',
                'Sirena elettronica',
                'Lampeggianti supplementari',
                'Fari di profondità',
                'Megafono esterno',
                'Sistema Priority',
                'Dash cam',
                'Body cam',
            ],

            // Comunicazioni
            'communications' => [
                'Radio TETRA',
                'Radio VHF',
                'Radio UHF',
                'Antenna radio',
                'Telefono satellitare',
                'Router 4G/5G',
                'Sistema GPS',
                'Localizzatore satellitare',
                'Tablet MDT',
            ],

            // Sicurezza e protezione
            'security' => [
                'Blindatura leggera',
                'Blindatura pesante',
                'Vetri antiproiettile',
                'Run-flat pneumatici',
                'Gabbia posteriore',
                'Divisorio abitacolo',
                'Cassaforte',
                'Sistema antifurto satellitare',
                'Kill switch',
            ],

            // Equipaggiamenti speciali
            'special' => [
                'Gancio traino',
                'Verricello anteriore',
                'Barra antincastro',
                'Portapacchi',
                'Box tetto',
                'Frigorifero',
                'Inverter 220V',
                'Presa USB multipla',
                'Supporto tablet',
                'Supporto PC',
            ],

            // Equipaggiamenti medici
            'medical' => [
                'Kit primo soccorso',
                'Defibrillatore DAE',
                'Bombola ossigeno',
                'Barella pieghevole',
                'Sedia portantina',
                'Kit trauma',
                'Frigorifero farmaci',
                'Monitor parametri vitali',
            ],

            // Equipaggiamenti operativi
            'operational' => [
                'Estintore',
                'Kit antipanne',
                'Coni segnalazione',
                'Torce LED',
                'Generatore portatile',
                'Compressore aria',
                'Kit attrezzi',
                'Catene neve',
                'Cavi avviamento',
                'Tanica carburante',
            ],

            // Personalizzazioni
            'custom' => [
                'Livrea istituzionale',
                'Adesivi identificativi',
                'Targa magnetica',
                'Sedili speciali',
                'Volante modificato',
                'Comandi al volante',
                'Pedane laterali',
                'Bull bar',
                'Skid plate',
            ],
        ];
    }

    /**
     * Ottieni categoria equipaggiamento
     *
     * @return string|null
     */
    public function getCategory(): ?string
    {
        $equipments = self::getTypicalEquipments();
        $name = strtolower($this->name);

        foreach ($equipments as $category => $items) {
            foreach ($items as $item) {
                if (str_contains(strtolower($item), $name) || str_contains($name, strtolower($item))) {
                    return $category;
                }
            }
        }

        return 'other';
    }

    /**
     * Ottieni icona per categoria
     *
     * @return string
     */
    public function getCategoryIcon(): string
    {
        $icons = [
            'emergency' => 'bi-exclamation-triangle-fill text-danger',
            'communications' => 'bi-broadcast text-primary',
            'security' => 'bi-shield-fill text-warning',
            'special' => 'bi-tools text-info',
            'medical' => 'bi-heart-pulse-fill text-danger',
            'operational' => 'bi-gear-fill text-secondary',
            'custom' => 'bi-palette-fill text-success',
            'other' => 'bi-box text-muted',
        ];

        return $icons[$this->getCategory()] ?? $icons['other'];
    }
}
