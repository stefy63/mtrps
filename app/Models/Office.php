<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ente',
        'name',
        'phone',
        'mail',
        'address',
        'description',
        'note',
    ];
    protected $appends = ['full_name'];

    public function movement(): HasMany
    {
        return $this->hasMany(Movement::class);
    }

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class)
            ->withPivot('date_from', 'date_to', 'note')
            ->withTimestamps();
    }

    public function activeCars(): BelongsToMany
    {
        return $this->cars()
            ->where(fn($q) => $q->whereNull('car_office.date_to')
                ->orWhere('car_office.date_to', '>=', now())
            );
    }

    public function activeMaintenance(): BelongsToMany
    {
        return $this->cars()->with('maintenances')
            ->whereHas('maintenances');
    }

    public function movementsTo()
    { 
                return $this->cars();
    }

    public function movementsFrom()
    {
       
        return $this->hasMany(Movement::class)->withoutGlobalScope('inprogress');
    }

    /**
     * Accessor per ottenere il nome completo dell'auto
     */
    protected function FullName(): Attribute
    {
        $fullName = "{$this->ente}";
        $fullName .= !empty($this->name) ? " - {$this->name}" : '';
        return Attribute::make(
            get: fn() => $fullName,
        );
    }
}
