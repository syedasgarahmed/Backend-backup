@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Airlines Management</h2>
        <table class="table table-bordered" id="bookingTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Booking Number</th>
                    <th>User</th>
                    <th>Flight Route</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>

    </div>

    <!-- Airline Details Modal -->
    <div class="modal fade" id="airlineDetailsModal" tabindex="-1" aria-labelledby="airlineDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="airlineDetailsModalLabel">Airline Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="airlineDetailsContent">
                    <!-- Airline details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeDetailsModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Details Modal -->
    <div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="bookingDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingDetailsModalLabel">Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="bookingDetailsContent">Loading...</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal-btn" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function closeDetailsModal() {
            $('#airlineDetailsModal').modal('hide');
        }
        $(document).ready(function() {
            var table = $('#bookingTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.getBookings') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'booking_number',
                        name: 'booking_number'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'flight_route',
                        name: 'flight_route'
                    },
                    {
                        data: 'status_indicator',
                        name: 'status_indicator'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });


            $(document).on('click', '.view-booking-details', function() {
                var bookingId = $(this).data('id');
                $.ajax({
                    url: '{{ url('admin/booking/details') }}/' + bookingId,
                    type: 'GET',
                    success: function(data) {
                        var details = `
                <p><strong>ID:</strong> ${data.id}</p>
                <p><strong>Booking Number:</strong> ${data.booking_number}</p>
                <p><strong>User:</strong> ${data.customer ? data.customer.first_name + ' ' + data.customer.last_name : 'Guest'}</p>
                <p><strong>Origin:</strong> ${data.origin_city ? data.origin_city.name : 'Unknown'}</p>
                <p><strong>Destination:</strong> ${data.destination_city ? data.destination_city.name : 'Unknown'}</p>
                <p><strong>Status:</strong> ${data.status_indicator}</p>
            `;
                        $('#bookingDetailsContent').html(details);
                        $('#bookingDetailsModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to load booking details.');
                    }
                });
            });

            // Close modal when clicking the 'Close' button or outside the modal
            $('.close-modal-btn').click(function() {
                $('#bookingDetailsModal').modal('hide');
            });

        });
    </script>
@endpush
