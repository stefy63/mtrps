<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'date_from' => 'datetime:Y-m-d',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenanceGarages()
    {
        return $this->belongsTo(MaintenanceGarage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenanceTypes()
    {
        return $this->belongsTo(MaintenanceType::class);
    }

}
