<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_number',
        'type',
        'owner_type'
    ];

    public function fuelRecords()
    {
        return $this->hasMany(FuelRecord::class);
    }
}
