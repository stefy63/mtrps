<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['maintenance_id',
        'name',
        'address',
        'piva',
        'cf',
        'iban',
        'pec',
        'mail',
        'phone1',
        'phone2',
        'phone3',
        'acc',
        'anti_mafia',
        'durc',
        'description',
        'note'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'garage_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cigs()
    {
        return $this->hasMany(\App\Models\Cig::class, 'id', 'maintenance_garage_id');
    }
    
}
