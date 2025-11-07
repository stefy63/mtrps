<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MaintenanceType
 *
 * @property $id
 * @property $maintenance_id
 * @property $name
 * @property $description
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property Maintenance $maintenance
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MaintenanceType extends Model
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
    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'type_id', 'id');
    }
    
}
