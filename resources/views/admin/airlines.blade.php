@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Airlines Management</h2>
        <table class="table table-bordered" id="airlineTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Flights</th>
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
@endsection

@push('scripts')
    <script>
        function closeDetailsModal() {
            $('#airlineDetailsModal').modal('hide');
        }
        $(document).ready(function() {
            var table = $('#airlineTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.getAirlines') }}',
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'flights',
                        name: 'flights',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $(document).on('click', '.view-airline-details', function() {
                var airlineId = $(this).data('id');
                $.ajax({
                    url: '{{ url('admin/airline/details') }}/' + airlineId,
                    type: 'GET',
                    success: function(data) {
                        var flightsList = data.flights.length > 0 ?
                            data.flights.map(flight => `
                    <li>
                        ${flight.flight_number} - 
                        ${flight.origin_city ? flight.origin_city.name : 'Unknown'} to 
                        ${flight.destination_city ? flight.destination_city.name : 'Unknown'}
                    </li>
                `).join('') :
                            'No Flights Available';

                        var details = `
                <p><strong>Name:</strong> ${data.name}</p>
                <p><strong>Country:</strong> ${data.country}</p>
                <p><strong>Flights:</strong></p>
                <ul>${flightsList}</ul>
            `;
                        $('#airlineDetailsContent').html(details);
                        $('#airlineDetailsModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to load airline details.');
                    }
                });
            });

        });
    </script>
@endpush
