<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// BookingOffice Model
class BookingOffice extends Model {
    use HasFactory;
    protected $table = 'bookingoffices';
    protected $fillable = ['city_id', 'address'];
    public function city() {
        return $this->belongsTo(City::class);
    }
}