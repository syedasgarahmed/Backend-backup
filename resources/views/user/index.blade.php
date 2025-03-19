<!DOCTYPE html>
<html>

<head>
    <title>User Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f0f0f0;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #bookingForm22 {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        #bookingForm22 div {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2>Book a Flight</h2>
            <form id="bookingForm22" method="POST">
                @csrf
                <div>
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>

                <div>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="phone" placeholder="Phone" required>
                </div>

                <div>
                    <select name="flight_id" id="flight_id" required></select>
                    <select name="booking_office_id" id="booking_office_id" required></select>
                </div>

                <div>
                    <input type="datetime-local" name="departure_datetime" id="departure_datetime" required>
                    <input type="hidden" name="arrival_datetime" id="arrival_datetime">
                </div>

                <div>
                    <select name="from_city_id" id="from_city_id" required></select>
                    <select name="to_city_id" id="to_city_id" required></select>
                </div>

                <div>
                    <select name="class_indicator" id="class_indicator" required>
                        <option value="">Select Class</option>
                        <option value="business">Business</option>
                        <option value="economy">Economy</option>
                    </select>
                </div>

                <div>
                    <input type="number" name="total_price" id="total_price" placeholder="Total Price" readonly
                        required>
                    <input type="number" name="amount_paid" id="amount_paid" placeholder="Amount Paid" readonly
                        required>
                </div>

                <div>
                    <input type="text" name="ticket_name" placeholder="Ticket Name" required>
                </div>

                <button type="submit">Book Flight</button>
            </form>
        </div>
    </div>

    <script>
        const economyPrice = 5000;
        const businessPrice = 10000;

        $(document).ready(function() {
            $.ajax({
                url: '/get-cities',
                type: 'GET',
                success: function(data) {
                    data.forEach(city => {
                        $('#from_city_id, #to_city_id').append(
                            `<option value="${city.id}">${city.name}</option>`);
                    });
                }
            });

            $.ajax({
                url: '/get-flights',
                type: 'GET',
                success: function(data) {
                    data.forEach(flight => {
                        $('#flight_id').append(
                            `<option value="${flight.id}">${flight.flight_name}</option>`);
                    });
                }
            });

            $.ajax({
                url: '/get-booking-offices',
                type: 'GET',
                success: function(data) {
                    data.forEach(office => {
                        $('#booking_office_id').append(
                            `<option value="${office.id}">${office.address}</option>`);
                    });
                }
            });

            $('#class_indicator').on('change', function() {
                const selectedClass = $(this).val();
                const price = selectedClass === 'business' ? businessPrice : economyPrice;
                $('#total_price').val(price);
                $('#amount_paid').val(price);
            });

        //    $('#departure_datetime').on('change', function() {
               // const departureTime = new Date($(this).val());
              //  const arrivalTime = new Date(departureTime.getTime() + 5 * 60 * 60 * 1000);

            //    const formattedArrival = arrivalTime.toISOString().slice(0, 16);
           //     $('#arrival_datetime').val(formattedArrival);
          //  });
            // Automatically fill arrival time
            $('input[name="departure_datetime"]').change(function() {
                const departureTime = new Date($(this).val());
                if (departureTime) {
                    const arrivalTime = new Date(departureTime.getTime() + 5 * 60 * 60 *
                    1000); // Add 5 hours
                    const formattedArrivalTime = arrivalTime.toISOString().slice(0,
                    16); // Format to match input type="datetime-local"
                    $('input[name="arrival_datetime"]').val(formattedArrivalTime);
                }
            });
            $('#bookingForm22').on('submit', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/user/book-flight',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message);
                        $('#bookingForm22')[0].reset();
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessage += `${errors[key][0]}\n`;
                            }
                        }
                        alert(errorMessage);
                    }
                });
            });
        });
    </script>
</body>

</html>
