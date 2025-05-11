<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MaintenanceGarage
 *
 * @property $id
 * @property $maintenance_id
 * @property $name
 * @property $piva
 * @property $cf
 * @property $iban
 * @property $pec
 * @property $acc
 * @property $anti_mafia
 * @property $durc
 * @property $description
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property Maintenance $maintenance
 * @property Cig[] $cigs
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MaintenanceGarage extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['maintenance_id', 'name', 'piva', 'cf', 'iban', 'pec', 'acc', 'anti_mafia', 'durc', 'description', 'note'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenance()
    {
        return $this->belongsTo(\App\Models\Maintenance::class, 'maintenance_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cigs()
    {
        return $this->hasMany(\App\Models\Cig::class, 'id', 'maintenance_garage_id');
    }
    
}
