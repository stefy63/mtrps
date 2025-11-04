<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class CarPlate
 *
 * @property $id
 * @property $car_id
 * @property $name
 * @property $type
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
class CarPlate extends Pivot
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'plate_id',
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
    //     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //     */
//    public function cars()
//    {
//        return $this->belongsToMany(Car::class)
//            ->withPivot('date_from', 'date_to', 'note')
//            ->withTimestamps();
//    }
//
//    public function equipments()
//    {
//        return $this->belongsTo(Equipment::class)
//            ->withPivot('date_from', 'date_to', 'note')
//            ->withTimestamps();;
//    }
//

}
