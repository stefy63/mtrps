<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class CarProfitAccount
 *
 * @property $id
 * @property $code
 * @property $name
 * @property $description
 * @property $category
 * @property $department
 * @property $responsible
 * @property $email
 * @property $phone
 * @property $budget_year
 * @property $budget_month
 * @property $is_active
 * @property $valid_from
 * @property $valid_to
 * @property $notes
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Car[] $cars
 * @property User $creator
 * @property User $updater
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarProfitAccount extends Model
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'category',
        'department',
        'responsible',
        'email',
        'phone',
        'budget_year',
        'budget_month',
        'is_active',
        'valid_from',
        'valid_to',
        'notes',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'budget_year' => 'decimal:2',
        'budget_month' => 'decimal:2',
        'is_active' => 'boolean',
        'valid_from' => 'date',
        'valid_to' => 'date',
    ];

    /**
     * Categorie disponibili per i centri di costo
     */
    const CATEGORIES = [
        'operativo' => 'Operativo',
        'amministrativo' => 'Amministrativo',
        'istituzionale' => 'Istituzionale',
        'emergenza' => 'Emergenza',
        'progetti' => 'Progetti Speciali',
        'manutenzione' => 'Manutenzione',
        'altro' => 'Altro'
    ];

    /**
     * Get category label
     */
    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category ?? 'N/D';
    }

    /**
     * Get full code with name
     */
    public function getFullCodeAttribute(): string
    {
        return $this->code . ' - ' . $this->name;
    }

    /**
     * Check if account is valid on a specific date
     */
    public function isValidOn($date = null): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $date = $date ? Carbon::parse($date) : Carbon::now();

        if ($this->valid_from && $date->lt($this->valid_from)) {
            return false;
        }

        if ($this->valid_to && $date->gt($this->valid_to)) {
            return false;
        }

        return true;
    }

    /**
     * Get remaining budget for the year
     */
    public function getRemainingBudgetYearAttribute(): ?float
    {
        if (!$this->budget_year) {
            return null;
        }

        // Qui andrebbe calcolato il budget rimanente basato sui costi effettivi
        // Per ora restituiamo un valore di esempio
        return $this->budget_year * 0.3; // 30% rimanente
    }

    /**
     * Get budget usage percentage
     */
    public function getBudgetUsagePercentageAttribute(): ?float
    {
        if (!$this->budget_year || $this->budget_year == 0) {
            return null;
        }

        $used = $this->budget_year - ($this->remaining_budget_year ?? 0);
        return round(($used / $this->budget_year) * 100, 2);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        if (!$this->is_active) {
            return 'secondary';
        }

        $now = Carbon::now();

        if ($this->valid_to && $now->gt($this->valid_to)) {
            return 'danger';
        }

        if ($this->valid_from && $now->lt($this->valid_from)) {
            return 'warning';
        }

        return 'success';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        if (!$this->is_active) {
            return 'Disattivo';
        }

        $now = Carbon::now();

        if ($this->valid_to && $now->gt($this->valid_to)) {
            return 'Scaduto';
        }

        if ($this->valid_from && $now->lt($this->valid_from)) {
            return 'Non ancora attivo';
        }

        return 'Attivo';
    }

    /**
     * Scope: Active accounts
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Valid accounts (active and within validity dates)
     */
    public function scopeValid(Builder $query, $date = null): Builder
    {
        $date = $date ? Carbon::parse($date) : Carbon::now();

        return $query->where('is_active', true)
            ->where(function ($q) use ($date) {
                $q->whereNull('valid_from')
                    ->orWhere('valid_from', '<=', $date);
            })
            ->where(function ($q) use ($date) {
                $q->whereNull('valid_to')
                    ->orWhere('valid_to', '>=', $date);
            });
    }

    /**
     * Scope: By category
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: By department
     */
    public function scopeByDepartment(Builder $query, string $department): Builder
    {
        return $query->where('department', 'like', "%{$department}%");
    }

    /**
     * Relations
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'car_profit_account_id');
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
     * Get cars count
     */
    public function getCarsCountAttribute(): int
    {
        return $this->cars()->count();
    }

    /**
     * Get active cars count
     */
    public function getActiveCarsCountAttribute(): int
    {
        return $this->cars()
            ->whereHas('carAssignees', function ($query) {
                $query->whereNull('date_to')
                    ->orWhere('date_to', '>=', Carbon::now());
            })
            ->count();
    }

    /**
     * Generate next code
     */
    public static function generateNextCode(string $prefix = 'CEC'): string
    {
        $lastAccount = self::where('code', 'like', $prefix . '%')
            ->orderBy('code', 'desc')
            ->first();

        if ($lastAccount && preg_match('/' . $prefix . '(\d+)/', $lastAccount->code, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }

        return sprintf('%s%04d', $prefix, $nextNumber);
    }
}
