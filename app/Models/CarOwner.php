<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CarOwner
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property Car[] $cars
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarOwner extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'note'];

    protected $appends = ['cars_count'];

    /**
     * @return HasMany
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'car_owner_id', 'id');
    }


    protected function CarsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->cars()->count(),
        );
    }
    
}
