<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
class CarEquipment extends Pivot
{
    protected $table = 'car_equipment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_from' => 'date:Y-m-d',
        'date_to' => 'date:Y-m-d',
    ];

    protected $fillable = [
        'car_id',
        'equipment_id',
        'date_from',
        'date_to',
        'note'
    ];

//
//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
//     */
//    public function cars(): Bel
//    {
//        return $this->belongsToMany(Car::class);
//    }
//
//    public function equipments()
//    {
//        return $this->belongsTo(Equipment::class);;
//    }

}
