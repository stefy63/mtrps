<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

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
        return $this->belongsToMany(\App\Models\Car::class, 'car_equipment', 'equipment_id', 'car_id')
                    ->withPivot('date_from', 'date_to', 'note')
                    ->withTimestamps();
    }

}
