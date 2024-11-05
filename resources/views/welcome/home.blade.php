@extends('welcome.layouts.webpage')
    @section('title', 'Welcome | Home')
    @section('content')     
        @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
        @endif
    
        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="{{ asset('hotelier/images/IMG-20231123-WA0031-1024x682.jpg') }}" alt="Image"  style="width: 32px; height: 600px;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">{{__('Luxury Accommodation')}}</h6>
                                <h5 class="display-5 text-white mb-4 animated slideInDown">{{__('Unwind in our breath-taking rooms...')}}</h5>
                                <a href="#rooms" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">{{__('Our Rooms')}}</a>
                                <a href="#book_now" class="btn btn-light py-md-3 px-md-5 animated slideInRight">{{__('Book A Room')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="{{ asset('hotelier/images/IMG-20231123-WA0001-1024x576.jpg') }}" alt="Image" style="width: 32px; height: 600px;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">{{__('Wine & Dine')}}</h6>
                                <h5 class="display-5 text-white mb-4 animated slideInDown">{{__('Savor exquiste dishes & drinks prepared by the best...')}}</h5> 
                                <a href="#book_now" class="btn btn-light py-md-3 px-md-5 animated slideInRight">{{__('Make A Reservation')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{__('Previous')}}</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{__('Next')}}</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Booking Start -->
        <div id="book_now" class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">
                    <div id="status"></div>
                    <form id="bookingForm" class="row g-2">
                        @csrf
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name"  />
                                    <div id="customer_name"></div>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="customer_number" id="customer_number" placeholder="Telephone"  />
                                    <div id="customer_number"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="date" id="date1" name="check_in" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="check_in" id="check_in"
                                            placeholder="Check in" data-target="#date1" data-toggle="datetimepicker" />
                                    </div>
                                    <div id="check_in"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="date" id="date2" data-target-input="nearest">
                                        <input type="text" name="check_out"  id="check_out" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date2" data-toggle="datetimepicker"/>
                                    </div>
                                    <div id="check_out"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="guest_number" id="guest_number" placeholder="Number of Guest"  />
                                    <div id="guest_number"></div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="coming_from" id="coming_from" placeholder="Coming From"  />
                                    <div id="coming_from"></div>
                                </div>
                                <div class="col-md-6">
                                    <textarea name="special_requests" class="form-control">Special Requests</textarea>
                                    <div id="special_requests"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                    <script>
                        window.routes = {
                            'booking.store': "{{ route('booking.store') }}",
                        };
                
                        const handleFormSubmit = (formId, routeName, method, componentToReload) => {
                            document.getElementById(formId).addEventListener('submit', function(e) {
                                e.preventDefault();
                                
                                const formData = Object.fromEntries(new FormData(this));
                                // formData._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                // console.log(formData);

                                LiveBlade.load(routeName, method, formData, `#${formId}`, componentToReload);
                                // this.reset(); 
                            });
                        };
                
                        handleFormSubmit('bookingForm', 'booking.store', 'POST', '');
                    </script>
                </div>
            </div>
        </div>
        <!-- Booking End -->

        <!-- About Start -->
        <div class="container-xxl py-5" id="about">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                        <h1 class="mb-4">{{ $about_us->title }}</h1>
                        <p class="mb-4">{{ $about_us->about_text }}</p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                        <!-- <h2 class="mb-1" data-toggle="counter-up">{{ $about_us->no_room }}</h2> -->
                                        <p class="mb-0">Luxurus Rooms</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                        <!-- <h2 class="mb-1" data-toggle="counter-up">{{ $about_us->no_staff }}</h2> -->
                                        <p class="mb-0">Committed Staffs</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                        <!-- <h2 class="mb-1" data-toggle="counter-up">{{ $about_us->no_clients }}</h2> -->
                                        <p class="mb-0">Friendly Environment</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="#rooms">Explore More</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" 
                                    src="{{ isset($about_photo[0]) ? asset('storage/' . $about_photo[0]->image) : asset('hotelier/img/about-1.jpg') }}" 
                                    style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" 
                                    src="{{ isset($about_photo[1]) ? asset('storage/' . $about_photo[1]->image) : asset('hotelier/img/about-2.jpg') }}">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" 
                                    src="{{ isset($about_photo[2]) ? asset('storage/' . $about_photo[2]->image) : asset('hotelier/img/about-3.jpg') }}">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" 
                                    src="{{ isset($about_photo[3]) ? asset('storage/' . $about_photo[3]->image) : asset('hotelier/img/about-4.jpg') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Room Start -->
        <div class="container-xxl py-5" id="rooms">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
                </div>
                <div class="row g-4">
                    @foreach ($rooms as $room)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="room-item shadow rounded overflow-hidden">
                                <div class="position-relative">
                                    <img class="img-fluid" 
                                        src="{{ isset($room->imageName) ? asset('storage/' . $room->imageName->image) : asset('hotelier/img/room-1.jpg') }}" 
                                        alt="Room Image">                                    
                                    <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{ appDefaultCurrency() }} {{ $room->price }}/Night</small>
                                </div>
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">{{ ucwords(str_replace('_', ' ', $room->name)) }}</h5>
                                        <div class="ps-2">
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{ $room->bed }} Bed</small>
                                        <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>{{ $room->bath }} Bath</small>
                                        <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                    </div>
                                    <p class="text-body mb-3">{{ $room->narration }}</p>
                                    <div class="d-flex justify-content-between">
                                        {{--<a class="btn btn-sm btn-primary rounded py-2 px-4" href="">View Detail</a> --}}
                                        <a class="btn btn-sm btn-dark rounded py-2 px-4" href="#book_now">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Room End -->

        <!-- Video Section Start -->
        <div class="container-xxl py-5 px-0 wow zoomIn" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-6 bg-dark d-flex align-items-center">
                    <div class="p-5">
                        <h6 class="section-title text-start text-white text-uppercase mb-3">Luxury Living</h6>
                        <h1 class="text-white mb-4">Discover A Brand Luxurious Hotel</h1>
                        <p class="text-white mb-4">Hursey Resort offers unmatched luxury and comfort in a stunning natural setting. With beautifully designed rooms, top-notch amenities, and personalized service, it’s the perfect escape for relaxation or a special getaway. Every detail is crafted to provide a truly indulgent experience.</p>
                        <a href="#rooms" class="btn btn-primary py-md-3 px-md-5 me-3">Our Rooms</a>
                        <a href="#book_now" class="btn btn-light py-md-3 px-md-5">Book A Room</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="video position-relative">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/PSsLob5qxmQ" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe id="video" class="embed-responsive-item" src="" allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Section End -->

        <script>
            // JavaScript to handle video modal behavior
            document.addEventListener('DOMContentLoaded', function () {
                const videoModal = document.getElementById('videoModal');
                const videoIframe = document.getElementById('video');

                // Trigger the video play on button click
                videoModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const videoSrc = button.getAttribute('data-src');
                    videoIframe.src = videoSrc + "?autoplay=1";  // Autoplay the video
                });

                // Stop the video when modal is closed
                videoModal.addEventListener('hide.bs.modal', function () {
                    videoIframe.src = "";  // Clear the src to stop the video
                });
            });
        </script>


        <!-- Service Start -->
        <div class="container-xxl py-5" id="service">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Our Services</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Services</span></h1>
                </div>
                <div class="row g-4">
                    @foreach ($services as $service)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a class="service-item rounded" href="">
                                <div class="position-relative">
                                    <img class="img-fluid" 
                                        src="{{ isset($service->service_icon) ? asset('storage/' . $service->serviceImagae->image) : asset('hotelier/img/room-1.jpg') }}" 
                                        alt="Room Image">                                    
                                    <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{ appDefaultCurrency() }} {{ $room->price }}/Night</small>
                                </div>
                                <div class="p-4 mt-2">
                                <div class="d-flex flex-column mb-3">
                                    <h5 class="mb-0">{{ ucwords(str_replace('_', ' ', $service->name)) }}</h5>
                                    <p class="text-body mb-3">{{ $service->narration }}</p>
                                </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Contact Start -->
        <div class="container-xxl py-5" id="contact">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Contact Us</h6>
                    <h1 class="mb-5"><span class="text-primary text-uppercase">Contact</span> For Any Query</h1>
                </div>
                <div class="row g-4">
                    {{--
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">Booking</h6>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>book@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">General</h6>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>info@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">Technical</h6>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>tech@example.com</p>
                            </div>
                        </div>
                    </div>
                    --}}
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                        <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d33.61315802966343!3d1.7566592181724643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1779b82bec260a49%3A0xc6af9fe4516698cd!2sHursey%20Resort!5e0!3m2!1sen!2sus!4v1603794290143!5m2!1sen!2sus"
                            frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                        </iframe>
                    </div>
                    <div class="col-md-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            @if (session('status'))
                                <div class="alert alert-info">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{route('store.message')}}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                            <label for="name">Your Name</label>
                                        </div>
                                        @error('name')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                            <label for="email">Your Email</label>
                                        </div>
                                        @error('email')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" name="subject"  placeholder="Subject" required>
                                            <label for="subject">Subject</label>
                                        </div>
                                        @error('subject')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="message" name="message" style="height: 150px"></textarea>
                                            <label for="message">Message</label>
                                        </div>
                                        @error('message')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

        <!-- Newsletter Start -->
        <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="row justify-content-center">
                <div class="col-lg-10 border rounded p-1">
                    <div class="border rounded text-center p-1">
                        <div class="bg-white rounded text-center p-5">
                            {{-- <h4 class="mb-4">Subscribe Our <span class="text-primary text-uppercase">Newsletter</span></h4>
                            <form action="{{ route('newsletter.subscribe') }}" method="POST"> <!-- Specify your form action -->
                                @csrf <!-- Include CSRF token for security -->
                                <div class="position-relative mx-auto" style="max-width: 400px;">
                                    <input id="email" class="form-control w-100 py-3 ps-4 pe-5" type="email" name="email" placeholder="Enter your email" required>
                                    <button type="submit" class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Submit</button>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter End -->

    @endsection
