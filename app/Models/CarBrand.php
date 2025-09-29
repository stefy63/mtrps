<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CarBrand
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
 * @mixin Builder
 */
class CarBrand extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'note'];


    /**
     * @return HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
    
}
