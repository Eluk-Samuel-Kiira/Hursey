
<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
    <div class="container pb-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-4">
                <div class="bg-primary rounded p-4">
                    <a href="/"><h1 class="text-white text-uppercase mb-3">{{ getMailOptions('app_name') }}</h1></a>
                    <p class="text-dark mb-0">
                        {{__('Welcome to Hursey Resort, Soroti City- Your Oasis of Comfort and Luxury!')}}
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="section-title text-start text-primary text-uppercase mb-4">{{__('Contact')}}</h6>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Otucu Opii, Soroti City, Ug</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ getMailOptions('app_contact') }}</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ getMailOptions('app_email') }}</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="row gy-5 g-4">
                    <div class="col-md-6">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">{{__('Company')}}</h6>
                        <a class="btn btn-link" href="#about">{{__('About Us')}}</a>
                        <a class="btn btn-link" href="">{{__('Contact Us')}}</a>
                        <a class="btn btn-link" href="">{{__('Terms & Condition')}}</a>
                        <a class="btn btn-link" href="">{{__('Support')}}</a>
                    </div>
                    <div class="col-md-6">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Services</h6>
                        <a class="btn btn-link" href="//">{{__('Bar & Restaurant')}}</a>
                        <a class="btn btn-link" href="//">{{__('Conference & Workshop')}}</a>
                        <a class="btn btn-link" href="//">{{__('Sports & Gaming')}}</a>
                        <a class="btn btn-link" href="//">{{__('Event & Party')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="/">{{ getMailOptions('app_name') }}</a>{{__(', All Right Reserved.')}} 
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        {{__('Designed By ')}}<a class="border-bottom" href="https://stardena.com" target="_blank">{{__('Stardena')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->