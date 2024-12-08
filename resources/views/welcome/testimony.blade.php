<div class="container">
    <button id="toggleButton" class="btn btn-primary py-md-2 px-md-3 me-2">Add Testimony</button>
    <div id="formContainer" style="display: none;">
        <form method="POST" action="{{route('testimony.store')}}" class="row g-2">
            @csrf
            <div class="col-md-10">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Name" required/>
                        <div id="name"></div>
                    </div>
                    <div class="col-md-8">
                        <textarea name="testimony" class="form-control" placeholder="Write Your Experience" required></textarea>
                        <div id="testimony"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100" type="submit">Submit</button>
            </div>
        </form>
    </div>

    <div class="owl-carousel testimonial-carousel py-5">
        @if ($testimonies->isEmpty())
            <p class="text-center text-muted">No Testimony Found</p>
        @else
            @foreach ($testimonies as $testimony)
                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p>{!! $testimony->testimony !!}</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ asset('hotelier/img/testimony.png') }}" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">{{ $testimony->name }}</h6>
                            <small>{{ $testimony->created_at->format('F j, Y') }}</small>
                        </div>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                </div>
            @endforeach
    @endif
    </div>
</div>

<script>
    document.getElementById("toggleButton").addEventListener("click", function () {
        const formContainer = document.getElementById("formContainer");
        if (formContainer.style.display === "none") {
            formContainer.style.display = "block";
            this.textContent = "Hide Testimony";
        } else {
            formContainer.style.display = "none";
            this.textContent = "Add Testimony";
        }
    });

</script>