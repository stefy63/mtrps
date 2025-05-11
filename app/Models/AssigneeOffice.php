<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AssigneeOffice
 *
 * @property $id
 * @property $car_assignee_id
 * @property $name
 * @property $description
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property CarAssignee $carAssignee
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AssigneeOffice extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['car_assignee_id', 'name', 'description', 'note'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carAssignee()
    {
        return $this->belongsTo(\App\Models\CarAssignee::class, 'car_assignee_id', 'id');
    }
    
}
