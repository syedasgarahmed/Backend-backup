<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// FlightAvailability Model
class FlightAvailability extends Model {
    use HasFactory;

    protected $table= 'flightavailability';
    protected $fillable = ['flight_id', 'departure_datetime', 'total_business_class_seats', 'booked_business_class_seats', 'total_economy_class_seats', 'booked_economy_class_seats'];
    public function flight() {
        return $this->belongsTo(Flight::class);
    }
}