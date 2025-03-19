<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use App\Models\Customer;
use App\Models\Booking;
use Illuminate\Http\Request;

class AirlineController extends Controller {
    public function index() {
        $airlines = Airline::all();
        return view('admin.airlines.index', compact('airlines'));
    }
}


