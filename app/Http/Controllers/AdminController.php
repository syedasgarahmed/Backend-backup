<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\{Airline, City, BookingOffice, AirportTax, ExchangeRate, Customer, Email, MailingAddress, Phone, Flight, FlightAvailability};

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    public function getUsers(Request $request)
    {
        $query = Customer::with(['emails', 'mailingAddresses', 'phones', 'bookings']); // Load related data

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<button class="btn btn-sm btn-primary view-details" data-id="' . $row->id . '">View Details</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function showUsers()
    {
        return view('admin.users');
    }

    public function getUserDetails($id)
    {
        $user = Customer::with(['emails', 'mailingAddresses', 'phones', 'bookings'])->findOrFail($id);

        $userData = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'emails' => $user->emails,
            'phones' => $user->phones,
            'mailing_addresses' => $user->mailingAddresses,
            'bookings' => $user->bookings
        ];

        return response()->json($userData);
    }

    public function getAirlines(Request $request)
    {
        $query = Airline::with(['flights.originCity', 'flights.destinationCity']); // Load related cities

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('flights', function ($row) {
                if ($row->flights->isEmpty()) {
                    return 'No Flights';
                }

                return implode(', ', $row->flights->pluck('flight_number')->toArray());
            })
            ->addColumn('action', function ($row) {
                return '<button class="btn btn-sm btn-primary view-airline-details" data-id="' . $row->id . '">View Details</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }




    public function getAirlineDetails($id)
    {
        $airline = Airline::with(['flights.originCity', 'flights.destinationCity'])->findOrFail($id);
        return response()->json($airline);
    }



    public function showAirlines()
    {
        return view('admin.airlines');
    }

    public function showBookings()
    {
        return view('admin.bookings');
    }

    public function getBookings(Request $request)
    {
        $query = Booking::with(['originCity', 'destinationCity', 'user']); // Eager load relationships

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('user', function ($row) {
                return $row->user ? $row->user->first_name . ' ' . $row->user->last_name : 'Guest';
            })
            ->addColumn('flight_route', function ($row) {
                $origin = $row->originCity ? $row->originCity->name : 'Unknown';
                $destination = $row->destinationCity ? $row->destinationCity->name : 'Unknown';
                return "{$origin} to {$destination}";
            })
            ->addColumn('action', function ($row) {
                return '<button class="btn btn-sm btn-primary view-booking-details" data-id="' . $row->id . '">View Details</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getBookingDetails($id)
    {
        $booking = Booking::with(['originCity', 'destinationCity', 'user'])->findOrFail($id);
        return response()->json($booking);
    }
}
