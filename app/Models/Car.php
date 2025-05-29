<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Car
 *
 * @property $id
 * @property $car_type_id
 * @property $car_owner_id
 * @property $car_brand_id
 * @property $car_power_id
 * @property $car_profit_account_id
 * @property $name
 * @property $model
 * @property $color
 * @property $cod_model
 * @property $profit_account
 * @property $tank
 * @property $km
 * @property $description
 * @property $winter_wheels
 * @property $wheels_type
 * @property $warranty
 * @property $tel_warranty
 * @property $chassis
 * @property $date_revision
 * @property $doc
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property CarBrand $carBrand
 * @property CarOwner $carOwner
 * @property CarPower $carPower
 * @property CarProfitAccount $carProfitAccount
 * @property CarType $carType
 * @property User $createdBy
 * @property User $updatedBy
 * @property CarAssignee[] $carAssignees
 * @property CarEquipment[] $carEquipments
 * @property CarFuel[] $carFuels
 * @property CarPlate[] $carPlates
 * @property CarSetup[] $carSetups
 * @property Cig[] $cigs
 * @property Maintenance[] $maintenances
 * @property Movement[] $movements
 * @package App
 * @mixin Builder
 */
class Car extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_type_id',
        'car_owner_id',
        'car_brand_id',
        'car_power_id',
        'car_profit_account_id',
        'name',
        'model',
        'color',
        'cod_model',
        'profit_account',
        'tank',
        'km',
        'description',
        'winter_wheels',
        'wheels_type',
        'warranty',
        'tel_warranty',
        'chassis',
        'date_revision',
        'doc',
        'note',
        'createdBy',
        'updatedBy'
    ];

    /**
     * @return BelongsTo
     */
    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class, 'car_brand_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function carOwner()
    {
        return $this->belongsTo(CarOwner::class, 'car_owner_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function carPower()
    {
        return $this->belongsTo(CarPower::class, 'car_power_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function carProfitAccount()
    {
        return $this->belongsTo(CarProfitAccount::class, 'car_profit_account_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function carType()
    {
        return $this->belongsTo(CarType::class, 'car_type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * @return HasMany
     */
    public function carAssignees()
    {
        return $this->hasMany(CarAssignee::class, 'id', 'car_id');
    }

    /**
     * @return HasMany
     */
    public function carEquipments()
    {
        return $this->hasMany(CarEquipment::class, 'id', 'car_id');
    }

    /**
     * @return HasMany
     */
    public function carFuels()
    {
        return $this->hasMany(CarFuel::class, 'id', 'car_id');
    }

    /**
     * @return HasMany
     */
    public function carPlates(): HasMany
    {
        return $this->hasMany(CarPlate::class);
    }

    /**
     * @return HasMany
     */
    public function carSetups()
    {
        return $this->hasMany(CarSetup::class, 'id', 'car_id');
    }

    /**
     * @return HasMany
     */
    public function cigs()
    {
        return $this->hasMany(Cig::class, 'id', 'car_id');
    }

    /**
     * @return HasMany
     */
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'id', 'car_id');
    }

    /**
     * @return HasMany
     */
    public function movements()
    {
        return $this->hasMany(Movement::class, 'id', 'car_id');
    }

    /**
     * Accessor per nome completo con dettagli per le select
     */
    public function getFullNameWithDetailsAttribute()
    {
        $brand = $this->carBrand?->name ?? 'N/A';
        $model = $this->model ?? '';
        $type = $this->carType?->name ?? 'N/A';
        
        return "{$this->name} - {$brand} {$model} ({$type})";
    }

    /**
     * Relazione per ottenere solo le targhe attive
     */
    public function activePlates()
    {
        return $this->hasMany(CarPlate::class)->where(function($query) {
            $query->where('date_from', '<=', now())
                  ->where(function($q) {
                      $q->whereNull('date_to')
                        ->orWhere('date_to', '>=', now());
                  });
        });
    }

    /**
     * Accessor per ottenere la targa attiva corrente
     */
    public function getCurrentPlateAttribute()
    {
        return $this->activePlates()->first();
    }

    /**
     * Scope per veicoli con targa attiva
     */
    public function scopeWithActivePlate($query)
    {
        return $query->whereHas('activePlates');
    }

    /**
     * Scope per veicoli senza targa attiva
     */
    public function scopeWithoutActivePlate($query)
    {
        return $query->whereDoesntHave('activePlates');
    }

}
