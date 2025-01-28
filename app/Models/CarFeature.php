<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarFeature extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_id',
        'abs',
        'air_conditioning',
        'power_windows',
        'cruise_control',
        'bluetooth_connectivity',
        'remote_start',
        'gps_navigation',
        'heated_seats',
        'climate_control',
        'rear_parking_sensors',
        'leather_seats',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'car_id' => 'integer',
        'abs' => 'boolean',
        'air_conditioning' => 'boolean',
        'power_windows' => 'boolean',
        'cruise_control' => 'boolean',
        'bluetooth_connectivity' => 'boolean',
        'remote_start' => 'boolean',
        'gps_navigation' => 'boolean',
        'heated_seats' => 'boolean',
        'climate_control' => 'boolean',
        'rear_parking_sensors' => 'boolean',
        'leather_seats' => 'boolean',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
