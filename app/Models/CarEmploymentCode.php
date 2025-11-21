<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarEmploymentCode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'description',
        'extended',
        'createdBy',
        'updatedBy'
    ];
    /**
     * @return HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
