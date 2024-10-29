
<div class="modal fade" id="editCurrency{{ $currency->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('roles._edit_currency')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editCurrencyForm{{ $currency->id }}" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="currency_code" class="form-label">{{__('roles.currency_code')}}</label>
                            <input type="text" name="currency_code" class="form-control" id="currency_code{{ $currency->id }}" value="{{ $currency->currency_code }}" required>
                            <div class="invalid-feedback">{{__('roles.please_currency')}}</div>
                            <div id="currency_code{{ $currency->id }}"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="symbol" class="form-label">{{__('roles.symbol')}}</label>
                            <input type="text" name="symbol" class="form-control" id="symbol{{ $currency->id }}" value="{{ $currency->symbol }}" required>
                            <div class="invalid-feedback">{{__('roles.please_symbol')}}</div>
                            <div id="symbol{{ $currency->id }}"></div>
                        </div>
                        
                    </div><br>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label">{{__('roles._status')}}</label>
                            <select class="form-select" id="status{{ $currency->id }}" name="status" required>
                                <option disabled value="">{{__('roles._choose')}}</option>
                                <option value="active" {{ $currency->status == 'active' ? 'selected' : '' }}>{{__('roles._active')}}</option>
                                <option value="inactive" {{ $currency->status == 'inactive' ? 'selected' : '' }}>{{__('roles._inactive')}}</option>
                            </select>
                            <div class="invalid-feedback">{{__('roles._status_select')}}</div>
                            <div id="status{{ $currency->id }}"></div>
                        </div> 

                        <div class="col-md-6 d-flex align-items-center">
                            <input type="checkbox" name="default" class="form-check-input me-2" id="default{{ $currency->id }}" value="1" 
                            {{ $currency->default == 1 ? 'checked' : '' }}>
                            <label for="default" class="form-label mb-0">{{__('roles.make_default')}}</label>
                            <div id="default{{ $currency->id }}"></div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModalButton{{ $currency->id }}" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="button" onclick="editInstanceLoop({{$currency->id}})" class="btn btn-primary">{{__('roles._update_currency')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->

<script>

    function editInstanceLoop(currencyId) {
        // console.log(currencyId);

        var form = document.getElementById('editCurrencyForm' + currencyId);
        var formData = new FormData(form);
        
        var data = Object.fromEntries(formData.entries());
        data.default = form.querySelector('input[name="default"]').checked ? 1 : 0;
        var updateUrl = '{{ route('currency.update', ['currency' => ':id']) }}'.replace(':id', currencyId);
        // console.log(updateUrl)


        LiveBlade.editLoop(data, updateUrl, '').then(noErrorStatus => {
            // console.log(noErrorStatus);
            //close modals in loops (optional)
            if (noErrorStatus) {
                var closeButton = document.getElementById('closeModalButton' + currencyId);
                if (closeButton) {
                    closeButton.click(); // Simulate a click on the close button
                }
            }
        }).catch(error => {
            console.error('An unexpected error occurred:', error);
        });
    }
</script>
