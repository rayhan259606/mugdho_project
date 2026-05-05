<footer class="footer bg-navy text-white pt-5 pb-3 position-relative overflow-hidden" style="background-color: #0f172a !important;">
    <div class="footer-shape-1"></div>
    <div class="container position-relative z-index-2">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="fw-bold mb-4 text-uppercase ls-1 text-white">Contact Info</h5>
                <div class="contact-item mb-3 d-flex align-items-center">
                    <div class="icon-circle me-3"><i class="fe fe-map-pin"></i></div>
                    <span class="text-white opacity-75">{{ $systemSetting->address ?? 'Dhaka, Bangladesh' }}</span>
                </div>
                <div class="contact-item mb-3 d-flex align-items-center">
                    <div class="icon-circle me-3"><i class="fe fe-phone"></i></div>
                    <span class="text-white opacity-75">{{ $systemSetting->phone ?? '+880 1XXX XXXXXX' }}</span>
                </div>
                <div class="contact-item mb-4 d-flex align-items-center">
                    <div class="icon-circle me-3"><i class="fe fe-mail"></i></div>
                    <span class="text-white opacity-75">{{ $systemSetting->email ?? 'info@example.com' }}</span>
                </div>
                <div class="social-links d-flex">
                    @foreach($socials as $social)
                        <a href="{{ $social->link }}" class="social-btn me-2" title="{{ $social->name }}">
                            <i class="fa fa-{{ strtolower($social->name) }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center text-md-start">
                <h5 class="fw-bold mb-4 text-uppercase ls-1 text-white">Stay Updated</h5>
                <p class="text-white opacity-75 mb-4">Subscribe to our newsletter for exclusive offers and news.</p>
                <form action="{{ route('subscriber.data.store') }}" method="POST" class="newsletter-form">
                    @csrf
                    <div class="input-group shadow-sm">
                        <input type="email" name="email" class="form-control border-0 px-4" placeholder="Your Email Address" required style="background: rgba(255,255,255,0.1) !important; color: #fff !important;">
                        <button class="btn btn-primary px-4 fw-bold" type="submit">Join</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-4 text-uppercase ls-1 text-center text-lg-start text-white">Quick Links</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled footer-links">
                            <li><a href="{{ route('home') }}" class="text-white opacity-75"><i class="fe fe-chevron-right me-1 text-primary"></i> Home</a></li>
                            <li><a href="{{ route('module.msm') }}" class="text-white opacity-75"><i class="fe fe-chevron-right me-1 text-primary"></i> Courses</a></li>
                            <li><a href="{{ route('module.gadgets') }}" class="text-white opacity-75"><i class="fe fe-chevron-right me-1 text-primary"></i> Gadgets</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled footer-links">
                            <li><a href="{{ url('/page/privacy-policy') }}" class="text-white opacity-75"><i class="fe fe-chevron-right me-1 text-primary"></i> Privacy</a></li>
                            <li><a href="{{ url('/page/terms-conditions') }}" class="text-white opacity-75"><i class="fe fe-chevron-right me-1 text-primary"></i> Terms</a></li>
                            <li><a href="{{ route('post.index') }}" class="text-white opacity-75"><i class="fe fe-chevron-right me-1 text-primary"></i> Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-5 opacity-10" style="border-color: rgba(255,255,255,0.1) !important;">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 text-white opacity-50">&copy; {{ date('Y') }} <span class="text-white fw-bold">{{ $systemSetting->name ?? env('APP_NAME') }}</span>. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <img src="{{ asset('backend/images/brand/cards.png') }}" alt="Payments" height="30" class="opacity-75 grayscale-0">
            </div>
        </div>
    </div>
</footer>

<style>
    .bg-navy { background-color: #0f172a !important; }
    .footer-shape-1 {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(99, 102, 241, 0.1);
        border-radius: 50%;
        z-index: 1;
    }
    .icon-circle {
        width: 35px;
        height: 35px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
    }
    .social-btn {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.1);
        color: #fff !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .social-btn:hover {
        background: #6366f1;
        color: #fff !important;
        transform: translateY(-3px);
    }
    .footer-links li { margin-bottom: 12px; }
    .footer-links a {
        color: rgba(255,255,255,0.7) !important;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
    }
    .footer-links a:hover {
        color: #fff !important;
        padding-left: 5px;
    }
    .newsletter-form .form-control {
        height: 50px;
        background: rgba(255,255,255,0.1) !important;
        color: #fff !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
    }
    .newsletter-form .form-control::placeholder { color: rgba(255,255,255,0.5) !important; }
</style>