<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarType
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
class CarType extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'note'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cars()
    {
        return $this->hasMany(\App\Models\Car::class, 'id', 'car_type_id');
    }
    
}
