<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Office extends Model
{
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
                ->using(CarAssignee::class)
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
