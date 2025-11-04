<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
class Plate extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'type', 'note'];

    /**
     * @return BelongsToMany
     */
    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class)
            ->using(CarPlate::class)
            ->withPivot('date_from', 'date_to', 'note')
            ->withTimestamps();
    }

}
