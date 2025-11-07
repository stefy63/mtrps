<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Maintenance
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
 * @property MaintenanceGarage[] $maintenanceGarages
 * @property MaintenanceType[] $maintenanceTypes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Maintenance extends Model
{
    protected static function booted()
    {
        static::addGlobalScope('closed', function (Builder $builder) {
            $builder->whereNull('date_to');
        });
    }

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['car_id', 'garage_id', 'type_id', 'description', 'date_from', 'date_to', 'note'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_from' => 'datetime:Y-m-d',
        'date_to' => 'datetime:Y-m-d',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenanceGarages(): BelongsTo
    {
        return $this->belongsTo(MaintenanceGarage::class, 'garage_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenanceTypes(): BelongsTo
    {
        return $this->belongsTo(MaintenanceType::class, 'type_id');
    }

}
