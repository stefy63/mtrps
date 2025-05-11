<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cig
 *
 * @property $id
 * @property $car_id
 * @property $maintenance_garage_id
 * @property $date
 * @property $ce
 * @property $description
 * @property $preventive
 * @property $final_report
 * @property $taxable
 * @property $vat
 * @property $cig
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property Car $car
 * @property MaintenanceGarage $maintenanceGarage
 * @property User $user_rup
 * @property User $user_support
 * @property User $user_tender_notice
 * @property User $user_tester
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cig extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['car_id', 'maintenance_garage_id', 'user_rup_id', 'user_support_id', 'user_tender_notice_id', 'user_tester_id', 'date', 'ce', 'description', 'preventive', 'final_report', 'taxable', 'vat', 'cig', 'note'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class, 'car_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maintenanceGarage()
    {
        return $this->belongsTo(\App\Models\MaintenanceGarage::class, 'maintenance_garage_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_rup()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_rup_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_support()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_support_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_tender_notice()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_tender_notice_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_tester()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_tester_id', 'id');
    }

}
