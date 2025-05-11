<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarPower
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Car[] $cars
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarPower extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cars()
    {
        return $this->hasMany(\App\Models\Car::class, 'id', 'car_power_id');
    }
    
}
