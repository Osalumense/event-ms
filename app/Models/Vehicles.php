<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'engine_number',
        'chassis_number',
        'vehicle_type',
        'brand',
        'model',
        'year',
        'color',
        'owner_id',
        'plate_number_id'
    ];
}
