@extends('layouts.admin')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Airlines Card -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Airlines</h2>
                <a href="{{ route('admin.showAirlines') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View Airlines
                </a>
            </div>

            <!-- Users Card -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Users</h2>
                <a href="{{ route('admin.viewUsers') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View Users
                </a>
            </div>

            <!-- Attributes Card -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Bookings</h2>
                <a href="{{ route('admin.showBookings') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
                    View Bookings
                </a>
            </div>


        </div>
    </div>
@endsection
