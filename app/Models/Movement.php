<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class Movement
 *
 * @property $id
 * @property $car_id
 * @property $driver_id
 * @property $requested_by
 * @property $authorized_by
 * @property $code
 * @property $status
 * @property $type
 * @property $purpose
 * @property $purpose_details
 * @property $departure_datetime
 * @property $arrival_datetime
 * @property $actual_departure
 * @property $actual_arrival
 * @property $departure_location
 * @property $departure_address
 * @property $departure_lat
 * @property $departure_lng
 * @property $arrival_location
 * @property $arrival_address
 * @property $arrival_lat
 * @property $arrival_lng
 * @property $km_start
 * @property $km_end
 * @property $km_total
 * @property $estimated_km
 * @property $estimated_duration
 * @property $route_type
 * @property $passengers_count
 * @property $passengers
 * @property $external_passengers
 * @property $fuel_liters
 * @property $fuel_cost
 * @property $toll_cost
 * @property $parking_cost
 * @property $other_costs
 * @property $cost_notes
 * @property $mission_order
 * @property $notes
 * @property $incidents
 * @property $requires_overnight
 * @property $overnight_location
 * @property $vehicle_check_before
 * @property $vehicle_check_after
 * @property $vehicle_damages
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Car $car
 * @property User $driver
 * @property User $requester
 * @property User $authorizer
 * @property User $creator
 * @property User $updater
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Movement extends Model
{

    protected static function booted()
    {
        static::addGlobalScope('inprogress', function (Builder $builder) {
            $builder->whereNull('date_to');
        });
    }

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'office_id',
        'code',
        'date_from',
        'date_to',
        'note',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_from' => 'date',
        'date_to' => 'date',
    ];

    /**
     * Relations
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Generate next movement code
     */
    public static function generateCode(): string
    {
        $year = date('Y');
        $lastMovement = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastMovement && preg_match('/MOV-' . $year . '-(\d+)/', $lastMovement->code, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }

        return sprintf('MOV-%s-%05d', $year, $nextNumber);
    }
}
