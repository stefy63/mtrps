<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

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
class CarAssignee extends Pivot
{

    protected $table = 'car_assignees';
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_from' => 'datetime:Y-m-d',
    ];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

}
