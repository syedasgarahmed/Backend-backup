<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Customer Model
class Phone extends Model {


    use HasFactory;

    protected $fillable=['local_number', 'area_code', 'country_code', 'type', 'customer_id'];
}