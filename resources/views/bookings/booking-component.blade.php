<div class="table-responsive" id="bookingIndexTable">
    <table class="table table-bordered table-striped" id="bookingTable">
        <thead>
            <tr>
                <th>{{__('#')}}</th>
                <th>{{__('Customer Name')}}</th>
                <th>{{__('Customer Number')}}</th>
                <th>{{__('Check In')}}</th>
                <th>{{__('Check Out')}}</th>
                <th>{{__('No of Guests')}}</th>
                <th>{{__('Comming From')}}</th>
                <th>{{__('Booking Date')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Transaction Status')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($bookings))
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ ucwords(str_replace('_', ' ', $booking->id)) }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $booking->customer_name)) }}</td>
                        <td>{{ $booking->customer_number }}</td>
                        <td>{{ $booking->check_in }}</td>
                        <td>{{ $booking->check_out }}</td>
                        <td>{{ $booking->guest_number }}</td>
                        <td>{{ $booking->coming_from }}</td>
                        <td>{{ $booking->created_at }}</td>
                        @if ($booking->status == 'reserved')
                            <td><span class="badge bg-primary"><i class="bi bi-star me-1"></i> {{ ucwords(str_replace('_', ' ', $booking->status)) }}</span></td>
                        @elseif ($booking->status == 'checked_in')
                            <td><span class="badge bg-warning"><i class="bi bi-exclamation-triangle me-1"></i> {{ ucwords(str_replace('_', ' ', $booking->status)) }}</span></td>
                        @elseif ($booking->status == 'checked_out')
                            <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> {{ ucwords(str_replace('_', ' ', $booking->status)) }}</span></td>
                        @else ($booking->status == 'canceled')
                            <td><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> {{ ucwords(str_replace('_', ' ', $booking->status)) }}</span></td>
                        @endif
                        @if ($booking->txn_status == 'pending')
                            <td><span class="badge bg-warning"><i class="bi bi-exclamation-triangle me-1"></i> {{ ucwords(str_replace('_', ' ', $booking->txn_status)) }}</span></td>
                        @elseif ($booking->txn_status == 'completed')
                            <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> {{ ucwords(str_replace('_', ' ', $booking->txn_status)) }}</span></td>
                        @elseif ($booking->txn_status == 'failed')
                            <td><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> {{ ucwords(str_replace('_', ' ', $booking->txn_status)) }}</span></td>
                        @endif
                        <td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-primary me-3" data-bs-toggle="modal" data-bs-target="#editBooking{{ $booking->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                @include('bookings.edit-booking')

                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteBooking{{ $booking->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                
                                <div class="modal" id="deleteBooking{{ $booking->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('roles.confirm_delete') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ __('roles.delete_message') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('auth._close') }}</button>
                                                <button type="button" class="btn btn-primary confirm-delete" 
                                                        data-item-url="{{ route('booking.destroy', $booking->id) }}" 
                                                        data-item-id="{{ $booking->id }}"
                                                        onclick="deleteItem(this)">
                                                    {{ __('auth._confirm_button') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <p>{{__('roles.no_users')}}</p>
            @endif
        </tbody>
    </table>
</div>
<script>
    function deleteItem(button) {
        // Get role information from data attributes
        const itemId = button.getAttribute('data-item-id');
        const deleteUrl = button.getAttribute('data-item-url'); // Directly get the pre-generated URL

        // Call your function to handle the deletion
        LiveBlade.loop(deleteUrl);

        // Optionally, remove the modal if exists
        const modalElement = document.getElementById(`deleteBooking${itemId}`); // Adjust based on your modal ID
        const modal = bootstrap.Modal.getInstance(modalElement); // Get the modal instance
        if (modal) {
            modal.hide();
        }
    }
</script>


<script>
    // Reusable function to filter table based on search input
    function setupTableSearch(inputId, tableId) {
        LiveBlade.searchTableItems(inputId, tableId)
    }

    // Set up the event listeners after the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        setupTableSearch('searchInput', 'bookingTable');
        
    });
</script>
