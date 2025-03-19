<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// City Model
class City extends Model {
    use HasFactory;
    protected $fillable = ['name', 'country'];
    public function bookingOffices() {
        return $this->hasMany(BookingOffice::class);
    }
    public function airportTaxes() {
        return $this->hasMany(AirportTax::class);
    }
}