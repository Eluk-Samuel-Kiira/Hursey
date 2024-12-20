
<div class="container-fluid bg-dark px-0">
    <div class="row gx-0">
        <div class="col-lg-3 bg-dark d-none d-lg-block">
            <a href="/" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center flex-column">
                <div class="d-flex align-items-center">
                    <img src="{{ getLogoImage() }}" alt="" style="width: 32px; height: auto; margin-right: 10px;">
                    <h1 class="m-0 text-primary text-uppercase" style="white-space: nowrap;">{{ getMailOptions('app_name') }}</h1>
                </div>
                <h2 class="m-0 text-primary text-uppercase" style="font-size: 1.25rem;">Resort Hotel</h2>
            </a>
        </div>
        <div class="col-lg-9">
            <div class="row gx-0 bg-white d-none d-lg-flex">
                <div class="col-lg-7 px-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        <p class="mb-0">{{ getMailOptions('app_email') }}</p>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center py-2">
                        <i class="fa fa-phone-alt text-primary me-2"></i>
                        <p class="mb-0">{{ getMailOptions('app_contact') }}</p>
                    </div>
                </div>
                {{--
                <div class="col-lg-5 px-5 text-end">
                    <div class="d-inline-flex align-items-center py-2">
                        <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                        <a class="" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                --}}
            </div>
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                <a href="/" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 text-primary text-uppercase">{{ getMailOptions('app_name') }}</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/" class="nav-item nav-link active">{{__('Home')}}</a>
                        <a href="#about" class="nav-item nav-link">{{__('About')}}</a>
                        <a href="#rooms" class="nav-item nav-link">{{__('Rooms')}}</a>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="booking.html" class="dropdown-item">Booking</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div> -->
                        <a href="#service" class="nav-item nav-link">{{__('Services')}}</a>
                        <a href="#testimonial" class="nav-item nav-link">{{__('Testimonies')}}</a>
                        <a href="#contact" class="nav-item nav-link">{{__('Contact')}}</a>
                    </div>
                    <a href="#book_now" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">{{__('Book Now!')}}<i class="fa fa-arrow-right ms-3"></i></a>
                </div>
            </nav>
        </div>
    </div>
</div>