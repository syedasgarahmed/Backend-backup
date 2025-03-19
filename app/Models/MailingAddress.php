<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// MailingAddress Model
class MailingAddress extends Model {

protected $table='mailingaddresses';
    use HasFactory;

    protected $fillable= ['country', 'postal_code', 'province_or_state', 'city', 'customer_id'];

}