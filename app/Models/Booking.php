<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Booking Model
class Booking extends Model {
    use HasFactory;
    protected $fillable = ['booking_number', 'customer_id', 'booking_office_id', 'flight_id', 'departure_datetime', 'arrival_datetime', 'class_indicator', 'total_price', 'status_indicator', 'amount_paid', 'outstanding_balance', 'ticket_name'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function flight() {
        return $this->belongsTo(Flight::class);
    }

    public function bookingOffice() {
        return $this->belongsTo(BookingOffice::class);
    }
}