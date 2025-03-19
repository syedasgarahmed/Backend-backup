<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Email;
use App\Models\Phone;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BookingOffice;
use App\Models\MailingAddress;
use App\Models\FlightAvailability;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{

    public function showBookingForm()
    {
        return view('user.index');
    }
    public function bookFlight(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'flight_id' => 'required|exists:flights,id',
            'booking_office_id' => 'required|exists:bookingoffices,id',
            'departure_datetime' => 'required|date',
            'arrival_datetime' => 'required|date|after:departure_datetime',
            'class_indicator' => 'required|in:business,economy',
            'total_price' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'ticket_name' => 'required|string|max:255',
        ]);

        // Check if the customer exists by email
        $customer = Customer::whereHas('emails', function ($query) use ($request) {
            $query->where('email', $request->email);
        })->first();

        if (!$customer) {
            // Create new customer
            $customer = Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            // Save email
            Email::create([
                'customer_id' => $customer->id,
                'email' => $request->email,
            ]);

            // Save phone
            Phone::create([
                'customer_id' => $customer->id,
                'type' => 'phone',
                'local_number' => $request->phone,
            ]);

            // Save mailing address (dummy data)
            MailingAddress::create([
                'customer_id' => $customer->id,
                'street' => 'Dummy Street',
                'city' => 'Dummy City',
                'province_or_state' => 'Dummy State',
                'postal_code' => '000000',
                'country' => 'Country',
            ]);
        }

        // Create the booking
        $booking = Booking::create([
            'booking_number' => 'BOOK-' . Str::random(8),
            'customer_id' => $customer->id,
            'booking_office_id' => $request->booking_office_id,
            'booking_date' => Carbon::now(),
            'flight_id' => $request->flight_id,
            'departure_datetime' => $request->departure_datetime,
            'arrival_datetime' => $request->arrival_datetime,
            'class_indicator' => $request->class_indicator,
            'total_price' => $request->total_price,
            'status_indicator' => 'booked',
            'amount_paid' => $request->amount_paid,
            'outstanding_balance' => $request->total_price - $request->amount_paid,
            'ticket_name' => $request->ticket_name,
        ]);

        return response()->json([
            'message' => 'Booking successful!',
            'booking' => $booking,
            'customer' => $customer
        ]);
    }


    public function getBookingOffices()
    {
        $bookingOffices = BookingOffice::all(['id', 'address']);
        return response()->json($bookingOffices);
    }

    public function getFlights()
    {
        $flights = Flight::all(['id', 'flight_number']);
        return response()->json($flights);
    }

    public function checkAvailability($flightId, $class)
    {
        $availability = FlightAvailability::where('flight_id', $flightId)->first();

        $availableSeats = ($class === 'economy')
            ? $availability->total_economy_class_seats - $availability->booked_economy_class_seats
            : $availability->total_business_class_seats - $availability->booked_business_class_seats;

        return response()->json(['availableSeats' => $availableSeats]);
    }
}
