
<div class="modal fade" id="createNewCurrency" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('roles.create_new_currency')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="createCurrencyForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="currency_code" class="form-label">{{__('roles.currency_code')}}</label>
                            <input type="text" name="currency_code" class="form-control" id="currency_code" required>
                            <div class="invalid-feedback">{{__('roles.please_currency')}}</div>
                            <div id="currency_code"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="symbol" class="form-label">{{__('roles.symbol')}}</label>
                            <input type="text" name="symbol" class="form-control" id="symbol" required>
                            <div class="invalid-feedback">{{__('roles.please_symbol')}}</div>
                            <div id="symbol"></div>
                        </div>
                        
                    </div><br>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label">{{__('roles._status')}}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option disabled value="">{{__('roles._choose')}}</option>
                                <option value="active" selected>{{__('roles._active')}}</option>
                                <option value="inactive">{{__('roles._inactive')}}</option>
                            </select>
                            <div class="invalid-feedback">{{__('roles._status_select')}}</div>
                            <div id="status"></div>
                        </div>
                    
                        <div class="col-md-6 d-flex align-items-center">
                            <input type="checkbox" name="default" class="form-check-input me-2" id="default" value="1">
                            <label for="default" class="form-label mb-0">{{__('roles.make_default')}}</label>
                            <div id="default"></div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('auth._close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('roles.create_currency')}}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Extra Large Modal-->
