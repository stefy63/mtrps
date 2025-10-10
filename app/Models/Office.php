<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        '*'
    ];


    public function assignees()
    {
        return $this->hasMany(CarAssignee::class);
    }

    public function movement()
    {
        return $this->hasMany(Movement::class);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_assignees')
            ->withPivot('date_from', 'date_to', 'note')
            ->withTimestamps();
    }
}
