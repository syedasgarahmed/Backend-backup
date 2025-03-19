<!DOCTYPE html>
<html>

<head>
    <title>User Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Book a Flight</h2>
        <form id="bookFlightForm">
            @csrf
            <!-- Customer Details -->
            <label>First Name:</label>
            <input type="text" name="first_name" required><br>

            <label>Last Name:</label>
            <input type="text" name="last_name" required><br>

            <label>Email:</label>
            <input type="email" name="email" required><br>

            <label>Phone:</label>
            <input type="text" name="phone" required><br>

            <!-- Booking Office Selection -->
            <label>Booking Office:</label>
            <select name="booking_office_id" id="bookingOfficeSelect" required>
                <option value="">Select Booking Office</option>
            </select><br>

            <!-- Flight Selection -->
            <label>Flight:</label>
            <select name="flight_id" id="flightSelect" required>
                <option value="">Select Flight</option>
            </select><br>

            <!-- Class Selection -->
            <label>Class:</label>
            <select name="class_indicator" id="classSelect" required>
                <option value="">Select Class</option>
                <option value="economy">Economy</option>
                <option value="business">Business</option>
            </select><br>

            <label>Available Seats:</label>
            <span id="availableSeats">-</span><br>

            <label>Total Price (₹):</label>
            <span id="totalPrice">0.00</span><br>

            <label>Amount Paid:</label>
            <input type="number" name="amount_paid" step="0.01" required><br>

            <label>Ticket Name:</label>
            <input type="text" name="ticket_name" required><br>

            <button type="submit">Book Flight</button>
        </form>

        <div id="bookingResponse22" class="mt-3"></div>
    </div>

    <script>
        const economyPrice = 5000;
        const businessPrice = 10000;

        // Load Booking Offices
        $.get('{{ route('user.getBookingOffices') }}', function(data) {
            data.forEach(office => {
                $('#bookingOfficeSelect').append(new Option(office.address, office.id));
            });
        });

        // Load Flights
        $.get('{{ route('user.getFlights') }}', function(data) {
            data.forEach(flight => {
                $('#flightSelect').append(new Option(flight.flight_number, flight.id));
            });
        });

        // Update Available Seats and Total Price
        $('#classSelect').on('change', function() {
            const flightId = $('#flightSelect').val();
            const selectedClass = $(this).val();

            if (flightId && selectedClass) {
                $.get(`{{ url('/check-availability') }}/${flightId}/${selectedClass}`, function(data) {
                    $('#availableSeats').text(data.availableSeats);
                    const price = (selectedClass === 'economy') ? economyPrice : businessPrice;
                    $('#totalPrice').text(price.toFixed(2));
                });
            }
        });

        // Form Submission
        $('#bookFlightForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('user.bookFlight') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    $('#bookFlightForm')[0].reset();
                    $('#availableSeats').text('-');
                    $('#totalPrice').text('0.00');
                },
                error: function(xhr) {
                    alert('Booking failed. Please try again.');
                }
            });
        });
    </script>
</body>

</html>