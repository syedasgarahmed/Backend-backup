<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Booking Model
class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['booking_number', 'customer_id', 'booking_office_id', 'flight_id', 'departure_datetime', 'arrival_datetime', 'class_indicator', 'total_price', 'status_indicator', 'amount_paid', 'outstanding_balance', 'ticket_name', 'to_location_id', 'from_location_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function bookingOffice()
    {
        return $this->belongsTo(BookingOffice::class);
    }
    // Relationship to the City model (From City)
    public function originCity()
    {
        return $this->belongsTo(City::class, 'from_location_id');
    }

    // Relationship to the City model (To City)
    public function destinationCity()
    {
        return $this->belongsTo(City::class, 'to_location_id');
    }
}
