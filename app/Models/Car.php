<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
 * @property $car_employment_code_id
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
 * @property CarEmploymentCode $carEmploymentCode
 * @property CarType $carType
 * @property User $createdBy
 * @property User $updatedBy
 * @property CarAssignee[] $carAssignees
 * @property CarEquipment[] $carEquipment
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

    protected static function booted()
    {
        static::addGlobalScope('available', function (Builder $builder) {
            $builder->whereAvailable(true);
        });
    }
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
        'car_employment_code_id',
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
        'available',
        'createdBy',
        'updatedBy',
    ];
    protected $appends = ['full_name'];

    public function carOffices()
    {
        return $this->belongsToMany(Office::class)
            ->using(CarAssignee::class)
            ->withPivot('date_from', 'date_to', 'note');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carEquipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class)
            ->using(CarEquipment::class)
            ->withPivot('date_from', 'date_to', 'note')
            ->withTimestamps();
    }


    /**
     * @return BelongsTo
     */
    public function carEmployment(): BelongsTo
    {
        return $this->belongsTo(CarEmploymentCode::class, 'car_employment_code_id');
    }


    /**
     * @return BelongsTo
     */
    public function carBrand(): BelongsTo
    {
        return $this->belongsTo(CarBrand::class);
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
     * @return HasMany
     */
    public function carFuels()
    {
        return $this->hasMany(CarFuel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carPlates(): BelongsToMany
    {
        return $this->belongsToMany(Plate::class)
            ->using(CarPlate::class)
            ->withPivot('date_from', 'date_to', 'note')
            ->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function carSetups()
    {
        return $this->hasMany(CarSetup::class);
    }

    /**
     * @return HasMany
     */
    public function cigs()
    {
        return $this->hasMany(Cig::class);
    }

    /**
     * @return HasMany
     */
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    /**
     * @return HasMany
     */
    public function movements()
    {
        return $this->hasMany(Movement::class);
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
     * Accessor per ottenere il nome completo dell'auto
     */
    protected function FullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->carBrand()->first()->name} - {$this->carType()->first()->name}",
        );
    }
}
