<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        '*'
    ];
    protected $appends = ['full_name'];


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

    /**
     * Accessor per ottenere il nome completo dell'auto
     */
    protected function FullName(): Attribute
    {
        $fullName = "{$this->ente}";
        $fullName .= !empty($this->name) ? " - {$this->name}" : '';
        return Attribute::make(
            get: fn () => $fullName,
        );
    }
}
