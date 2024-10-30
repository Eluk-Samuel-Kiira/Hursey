
<div class="modal fade" id="editBooking{{ $booking->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Reservation Of')}} {{ $booking->customer_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editBookingForm{{ $booking->id }}" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" class="form-control" id="booking_id{{ $booking->id }}" value="{{ $booking->id }}" name="booking_id">

                        <div class="col-md-4">
                            <label for="customer_name" class="form-label">{{__('Customer Name')}}</label>
                            <input type="text" class="form-control" id="customer_name{{ $booking->id }}" value="{{ $booking->customer_name }}" name="customer_name">
                            <div id="customer_name{{ $booking->id }}"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="customer_number" class="form-label">{{__('Customer Number')}}</label>
                            <input type="number" class="form-control" id="customer_number{{ $booking->id }}" value="{{ $booking->customer_number }}" name="customer_number">
                            <div id="customer_number{{ $booking->id }}"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="guest_number" class="form-label">{{__('Number of Guest')}}</label>
                            <input type="number" class="form-control" id="guest_number{{ $booking->id }}" value="{{ $booking->guest_number }}" name="guest_number">
                            <div id="guest_number{{ $booking->id }}"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="coming_from" class="form-label">{{__('Coming From')}}</label>
                            <input type="text" class="form-control" id="coming_from{{ $booking->id }}" value="{{ $booking->coming_from }}" name="coming_from">
                            <div id="coming_from{{ $booking->id }}"></div>
                        </div>
                                               

                    </div><br>

                    <div class="row g-3">
                        
                        <div class="col-md-3">
                            <label for="check_in" class="form-label">{{ __('Check In') }}</label>
                            <input type="date" class="form-control" id="check_in{{ $booking->id }}" 
                                   value="{{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }}" 
                                   name="check_in" required>
                            <div id="check_in{{ $booking->id }}"></div>
                        </div> 
                        
                        <div class="col-md-3">
                            <label for="check_out" class="form-label">{{ __('Check Out') }}</label>
                            <input type="date" class="form-control" id="check_out{{ $booking->id }}" 
                                   value="{{ \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d') }}" 
                                   name="check_out" required>
                            <div id="check_out{{ $booking->id }}"></div>
                        </div>  

                        <div class="col-md-3">
                            <label for="status" class="form-label">Booking Status</label>
                            <select class="form-select" id="status{{ $booking->id }}" name="status" required>
                                <option value="reserved" {{ old('status', $booking->status ?? '') === 'reserved' ? 'selected' : '' }}>Reserved</option>
                                <option value="checked_in" {{ old('status', $booking->status ?? '') === 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                <option value="checked_out" {{ old('status', $booking->status ?? '') === 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                <option value="canceled" {{ old('status', $booking->status ?? '') === 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                            <div id="status{{ $booking->id }}"></div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="txn_status" class="form-label">Transaction Status</label>
                            <select class="form-select" id="txn_status{{ $booking->id }}" name="txn_status" required>
                                <option value="pending" {{ old('txn_status', $booking->txn_status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('txn_status', $booking->txn_status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ old('txn_status', $booking->txn_status ?? '') === 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                            <div id="txn_status{{ $booking->id }}"></div>
                        </div>                        

                    </div><br>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="special_requests" class="form-label">{{__('Special Request')}}</label>
                            <textarea id="special_requests{{ $booking->id }}" name="special_requests" class="form-control" rows="3" required>
                                {!! $booking->special_requests !!}
                            </textarea>
                            <div id="special_requests{{ $booking->id }}"></div>
                        </div>
                    </div>
           
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModalButton{{ $booking->id }}" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="button" onclick="editInstanceLoop({{$booking->id}})" class="btn btn-primary">{{__('Save Changes')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    function editInstanceLoop(uniqueId) {
        // console.log(uniqueId);

        var form = document.getElementById('editBookingForm' + uniqueId);

        var formData = new FormData(form);
        var data = Object.fromEntries(formData.entries());

        var updateUrl = '{{ route('booking.update', ['booking' => ':id']) }}'.replace(':id', uniqueId);
        // console.log(data)


        LiveBlade.editLoop(data, updateUrl, '').then(noErrorStatus => {
            // console.log(noErrorStatus);
            //close modals in loops (optional)
            if (noErrorStatus) {
                var closeButton = document.getElementById('closeModalButton' + uniqueId);
                if (closeButton) {
                    closeButton.click(); // Simulate a click on the close button
                }

            }
        }).catch(error => {
            console.error('An unexpected error occurred:', error);
        });
    }
</script>