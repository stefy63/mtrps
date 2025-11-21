<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;
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

}
