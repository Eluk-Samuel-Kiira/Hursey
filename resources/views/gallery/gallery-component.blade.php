<div class="row" id="galleryComponent">
    @foreach ($galleries as $gallery)
        <div class="col-lg-3 d-flex">
            <div class="card me-3">
                <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" alt="{{ $gallery->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $gallery->name }}</h5>
                    <!-- Form to delete the image -->
                    <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Remove profile image" onclick="return confirm('Are you sure you want to delete this image?');">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    <form action="{{ route('galleries.toggleAboutStatus', $gallery->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-secondary btn-sm" title="Toggle about page status" onclick="return confirm('Are you sure you want to change the about page status?');">
                            <i class="bi bi-file-medical-fill"></i> 
                            {{ $gallery->about_status === 'active' ? 'about-page' : 'none' }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    @endforeach
</div>
