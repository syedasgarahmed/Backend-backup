@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>User Management</h2>
        <table id="userTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- User Details Modal -->
    <div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="userDetailsContent">
                    <!-- User details will be displayed here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeUserDetailsModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.getUsers') }}',
                columns: [{
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'emails',
                        name: 'emails.email',
                        render: function(data) {
                            // Check if emails exist and return the first email found
                            return data && data.length > 0 ? data[0].email : 'N/A';
                        },
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // View User Details
            $(document).on('click', '.view-details', function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: '{{ url('admin/user/details') }}/' + userId,
                    type: 'GET',
                    success: function(data) {
                        var userDetails = `
                <p><strong>ID:</strong> ${data.id}</p>
                <p><strong>First Name:</strong> ${data.first_name}</p>
                <p><strong>Last Name:</strong> ${data.last_name}</p>
                <p><strong>Emails:</strong> ${data.emails.map(email => email.email).join(', ') || 'N/A'}</p>
                <p><strong>Phone Numbers:</strong> ${data.phones.map(phone => `${phone.country_code}-${phone.area_code}-${phone.local_number}`).join(', ') || 'N/A'}</p>
                <p><strong>Mailing Addresses:</strong> ${data.mailing_addresses.map(address => `${address.street}, ${address.city}, ${address.province_or_state}, ${address.postal_code}, ${address.country}`).join('; ') || 'N/A'}</p>
                <p><strong>Bookings:</strong> ${data.bookings.length > 0 ? data.bookings.map(booking => booking.booking_number).join(', ') : 'No Bookings'}</p>
            `;
                        $('#userDetailsContent').html(userDetails);
                        $('#userDetailsModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to load user details.');
                    }
                });
            });



        });

        function closeUserDetailsModal() {
            $('#userDetailsModal').modal('hide');
        }
    </script>
@endpush
