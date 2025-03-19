<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Flight Model
class Flight extends Model {
    use HasFactory;
    protected $fillable = ['flight_number', 'airline_id', 'business_class_indicator', 'smoking_allowed', 'origin_city_id', 'destination_city_id'];

    public function airline() {
        return $this->belongsTo(Airline::class);
    }

    public function originCity() {
        return $this->belongsTo(City::class, 'origin_city_id');
    }

    public function destinationCity() {
        return $this->belongsTo(City::class, 'destination_city_id');
    }

    public function availability() {
        return $this->hasMany(FlightAvailability::class);
    }
}