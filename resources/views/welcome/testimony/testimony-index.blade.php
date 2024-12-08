<div class="table-responsive" id="messageIndexTable">
    <table class="table table-bordered table-striped" id="messageTable">
        <thead>
            <tr>
                <th>{{__('Name')}}</th>
                <th>{{__('Testimony')}}</th>
                <th>{{__('Create At')}}</th>
                <th>{{__('roles._action')}}</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($testimonies))
                @foreach($testimonies as $testimony)
                    <tr>
                        <td>{{ ucwords(str_replace('_', ' ', $testimony->name)) }}</td>
                        <td>{!! $testimony->testimony !!}</td>
                        <td>{{ $testimony->created_at }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTestimony{{ $testimony->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                
                                <div class="modal" id="deleteTestimony{{ $testimony->id }}" tabindex="-1">
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

                                                <!-- Delete Form -->
                                                <form action="{{ route('testimony.destroy', $testimony->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">{{ __('auth._confirm_button') }}</button>
                                                </form>
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

