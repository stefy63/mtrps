<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function movement()
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
        return $this->activeCars()
            ->whereHas('maintenances');
    }

    public function movementsTo(): BelongsToMany
    {
        return $this->activeCars()
            ->whereHas('movements');
    }

    public function movementsFrom(): HasMany
    {
        return $this->hasMany(Movement::class);
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
