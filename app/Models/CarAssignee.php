<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarAssignee
 *
 * @property $id
 * @property $car_id
 * @property $name
 * @property $description
 * @property $date_from
 * @property $date_to
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property Car $car
 * @property AssigneeOffice[] $assigneeOffices
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarAssignee extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['car_id', 'name', 'description', 'date_from', 'date_to', 'note'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_from' => 'datetime:Y-m-d',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class, 'car_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assigneeOffices()
    {
        return $this->hasMany(\App\Models\AssigneeOffice::class, 'id', 'car_assignee_id');
    }

    /**
 * Scope per assegnazioni correnti (attive)
 */
public function scopeCurrent($query)
{
    return $query->where('date_from', '<=', now())
                 ->where(function($q) {
                     $q->whereNull('date_to')
                       ->orWhere('date_to', '>=', now());
                 });
}

/**
 * Scope per assegnazioni scadute
 */
public function scopeExpired($query)
{
    return $query->whereNotNull('date_to')
                 ->where('date_to', '<', now());
}

/**
 * Scope per assegnazioni future
 */
public function scopeFuture($query)
{
    return $query->where('date_from', '>', now());
}

/**
 * Accessor per determinare se l'assegnazione è attiva
 */
public function getIsActiveAttribute()
{
    $now = now();
    $dateFrom = \Carbon\Carbon::parse($this->date_from);
    $dateTo = $this->date_to ? \Carbon\Carbon::parse($this->date_to) : null;
    
    return $now >= $dateFrom && (!$dateTo || $now <= $dateTo);
}

/**
 * Accessor per ottenere lo stato dell'assegnazione
 */
public function getStatusAttribute()
{
    $now = now();
    $dateFrom = \Carbon\Carbon::parse($this->date_from);
    $dateTo = $this->date_to ? \Carbon\Carbon::parse($this->date_to) : null;
    
    if ($now < $dateFrom) {
        return 'future';
    } elseif ($dateTo && $now > $dateTo) {
        return 'expired';
    } else {
        return 'active';
    }
}

/**
 * Accessor per ottenere la durata dell'assegnazione
 */
public function getDurationInDaysAttribute()
{
    $dateFrom = \Carbon\Carbon::parse($this->date_from);
    $dateTo = $this->date_to ? \Carbon\Carbon::parse($this->date_to) : now();
    
    return $dateFrom->diffInDays($dateTo);
}

/**
 * Accessor per nome completo con descrizione
 */
public function getFullNameAttribute()
{
    if ($this->description) {
        return $this->name . ' - ' . $this->description;
    }
    return $this->name;
}

/**
 * Scope per assegnazioni per veicolo specifico
 */
public function scopeForVehicle($query, $carId)
{
    return $query->where('car_id', $carId);
}

/**
 * Scope per assegnazioni che si sovrappongono con un periodo specifico
 */
public function scopeOverlapping($query, $dateFrom, $dateTo = null)
{
    $dateTo = $dateTo ?? '9999-12-31';
    
    return $query->where('date_from', '<=', $dateTo)
                 ->where(function($q) use ($dateFrom) {
                     $q->whereNull('date_to')
                       ->orWhere('date_to', '>=', $dateFrom);
                 });
}

/**
 * Metodo per verificare se c'è sovrapposizione con altre assegnazioni
 */
public function hasOverlaps($carId = null, $dateFrom = null, $dateTo = null, $excludeId = null)
{
    $carId = $carId ?? $this->car_id;
    $dateFrom = $dateFrom ?? $this->date_from;
    $dateTo = $dateTo ?? $this->date_to;
    
    $query = static::where('car_id', $carId)
                   ->overlapping($dateFrom, $dateTo);
    
    if ($excludeId || $this->id) {
        $query->where('id', '!=', $excludeId ?? $this->id);
    }
    
    return $query->exists();
}

}
