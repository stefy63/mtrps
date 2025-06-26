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
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'driver_id',
        'requested_by',
        'authorized_by',
        'code',
        'status',
        'type',
        'purpose',
        'purpose_details',
        'departure_datetime',
        'arrival_datetime',
        'actual_departure',
        'actual_arrival',
        'departure_location',
        'departure_address',
        'departure_lat',
        'departure_lng',
        'arrival_location',
        'arrival_address',
        'arrival_lat',
        'arrival_lng',
        'km_start',
        'km_end',
        'km_total',
        'estimated_km',
        'estimated_duration',
        'route_type',
        'passengers_count',
        'passengers',
        'external_passengers',
        'fuel_liters',
        'fuel_cost',
        'toll_cost',
        'parking_cost',
        'other_costs',
        'cost_notes',
        'mission_order',
        'notes',
        'incidents',
        'requires_overnight',
        'overnight_location',
        'vehicle_check_before',
        'vehicle_check_after',
        'vehicle_damages',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'departure_datetime' => 'datetime',
        'arrival_datetime' => 'datetime',
        'actual_departure' => 'datetime',
        'actual_arrival' => 'datetime',
        'passengers' => 'array',
        'requires_overnight' => 'boolean',
        'vehicle_check_before' => 'boolean',
        'vehicle_check_after' => 'boolean',
        'departure_lat' => 'decimal:7',
        'departure_lng' => 'decimal:7',
        'arrival_lat' => 'decimal:7',
        'arrival_lng' => 'decimal:7',
        'fuel_liters' => 'decimal:2',
        'fuel_cost' => 'decimal:2',
        'toll_cost' => 'decimal:2',
        'parking_cost' => 'decimal:2',
        'other_costs' => 'decimal:2',
    ];

    /**
     * Status disponibili
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Tipi di movimento disponibili
     */
    const TYPE_SERVICE = 'servizio';
    const TYPE_MISSION = 'missione';
    const TYPE_TRANSFER = 'trasferimento';
    const TYPE_EMERGENCY = 'emergenza';
    const TYPE_MAINTENANCE = 'manutenzione';
    const TYPE_OTHER = 'altro';

    /**
     * Get available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'In attesa',
            self::STATUS_APPROVED => 'Approvato',
            self::STATUS_IN_PROGRESS => 'In corso',
            self::STATUS_COMPLETED => 'Completato',
            self::STATUS_CANCELLED => 'Annullato',
        ];
    }

    /**
     * Get available types
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_SERVICE => 'Servizio',
            self::TYPE_MISSION => 'Missione',
            self::TYPE_TRANSFER => 'Trasferimento',
            self::TYPE_EMERGENCY => 'Emergenza',
            self::TYPE_MAINTENANCE => 'Manutenzione',
            self::TYPE_OTHER => 'Altro',
        ];
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return self::getStatuses()[$this->status] ?? $this->status;
    }

    /**
     * Get type label
     */
    public function getTypeLabelAttribute(): string
    {
        return self::getTypes()[$this->type] ?? $this->type;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_APPROVED => 'info',
            self::STATUS_IN_PROGRESS => 'primary',
            self::STATUS_COMPLETED => 'success',
            self::STATUS_CANCELLED => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Calculate total km
     */
    public function calculateKmTotal(): ?int
    {
        if ($this->km_end && $this->km_start) {
            return $this->km_end - $this->km_start;
        }
        return null;
    }

    /**
     * Calculate total cost
     */
    public function getTotalCostAttribute(): float
    {
        return ($this->fuel_cost ?? 0) +
               ($this->toll_cost ?? 0) +
               ($this->parking_cost ?? 0) +
               ($this->other_costs ?? 0);
    }

    /**
     * Get duration in minutes
     */
    public function getDurationAttribute(): ?int
    {
        if ($this->actual_departure && $this->actual_arrival) {
            return $this->actual_departure->diffInMinutes($this->actual_arrival);
        }
        if ($this->departure_datetime && $this->arrival_datetime) {
            return $this->departure_datetime->diffInMinutes($this->arrival_datetime);
        }
        return null;
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute(): ?string
    {
        $duration = $this->duration;
        if (!$duration) return null;

        $hours = floor($duration / 60);
        $minutes = $duration % 60;

        if ($hours > 0) {
            return sprintf('%dh %02dm', $hours, $minutes);
        }
        return sprintf('%dm', $minutes);
    }

    /**
     * Check if movement overlaps with another
     */
    public function overlapsWithMovement($startDate, $endDate, $excludeId = null): bool
    {
        $query = self::where('car_id', $this->car_id)
            ->where(function ($q) use ($startDate, $endDate) {
                $q->whereBetween('departure_datetime', [$startDate, $endDate])
                    ->orWhereBetween('arrival_datetime', [$startDate, $endDate])
                    ->orWhere(function ($q2) use ($startDate, $endDate) {
                        $q2->where('departure_datetime', '<=', $startDate)
                            ->where('arrival_datetime', '>=', $endDate);
                    });
            })
            ->whereNotIn('status', [self::STATUS_CANCELLED]);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
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

    /**
     * Scope: Active movements
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNotIn('status', [self::STATUS_CANCELLED]);
    }

    /**
     * Scope: Pending movements
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope: In progress movements
     */
    public function scopeInProgress(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    /**
     * Scope: Completed movements
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope: For date range
     */
    public function scopeForDateRange(Builder $query, $startDate, $endDate): Builder
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->whereBetween('departure_datetime', [$startDate, $endDate])
                ->orWhereBetween('arrival_datetime', [$startDate, $endDate]);
        });
    }

    /**
     * Scope: For driver
     */
    public function scopeForDriver(Builder $query, $driverId): Builder
    {
        return $query->where('driver_id', $driverId);
    }

    /**
     * Scope: For car
     */
    public function scopeForCar(Builder $query, $carId): Builder
    {
        return $query->where('car_id', $carId);
    }

    /**
     * Relations
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function authorizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'authorized_by');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get passengers users
     */
    public function getPassengersUsersAttribute()
    {
        if (empty($this->passengers)) {
            return collect();
        }
        return User::whereIn('id', $this->passengers)->get();
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        // Generate code on creation
        static::creating(function ($movement) {
            if (empty($movement->code)) {
                $movement->code = self::generateCode();
            }

            // Calculate km_total if both km_start and km_end are provided
            if ($movement->km_start && $movement->km_end) {
                $movement->km_total = $movement->km_end - $movement->km_start;
            }
        });

        // Update km_total on update
        static::updating(function ($movement) {
            if ($movement->km_start && $movement->km_end) {
                $movement->km_total = $movement->km_end - $movement->km_start;
            }
        });
    }
}
