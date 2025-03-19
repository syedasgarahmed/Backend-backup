<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Customer Model
class Customer extends Model {
    use HasFactory;
    protected $fillable = ['first_name', 'last_name'];

    public function mailingAddresses() {
        return $this->hasMany(MailingAddress::class);
    }

    public function phones() {
        return $this->hasMany(Phone::class);
    }

    public function emails() {
        return $this->hasMany(Email::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}