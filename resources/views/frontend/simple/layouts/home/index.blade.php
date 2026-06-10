@extends('frontend.simple.app')

@section('content')
<!-- BANNER SLIDER -->
@if(count($banners) > 0)
<section class="banner-slider position-relative overflow-hidden">
    <div id="bannerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($banners as $key => $banner)
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="true"></button>
            @endforeach
        </div>
<div class="carousel-inner custom-premium-slider">
    @foreach($banners as $key => $banner)
    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
        
        <!-- Premium Ambient Image Wrapper -->
        <div class="banner-image-container">
            <img src="{{ asset($banner->image) }}" class="d-block w-100 banner-img" alt="{{ $banner->title }}">
            <!-- Semi-transparent cinematic dark overlay for text readability -->
            <div class="banner-overlay-gradient"></div>
        </div>
        
        <!-- Fully Fluid Responsive Caption Content -->
        <div class="carousel-caption custom-caption-alignment animate__animated animate__fadeInUp">
            <div class="container px-3 px-sm-4">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-8 text-start">
                        
                        <!-- Mini Welcome Badge -->
                        {{-- <span class="badge bg-white-soft text-white fw-semibold px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fs-11 border border-white-10 d-inline-flex align-items-center">
                            <span class="pulse-dot me-2"></span> Exclusive Offer
                        </span> --}}
                        
                        <!-- Main Strategic Heading Title -->
                        <h1 class="display-3 fw-black mb-3 text-white main-title text-balance">
                            {{ $banner->title }}
                        </h1>
                        
                        <!-- Subtitle Description -->
                        <p class="fs-5 mb-4 mb-md-5 text-white-90 sub-title max-w-600">
                            {{ $banner->subtitle }}
                        </p>
                        
                        <!-- Action Trigger CTA Button -->
                        @if($banner->link)
                        <div class="cta-wrapper">
                            <a href="{{ $banner->link }}" class="btn btn-premium-white rounded-pill px-4 py-3 fw-bold shadow-premium hover-scale d-inline-flex align-items-center gap-2">
                                Explore Now <i class="fe fe-arrow-right fs-16 transition-arrow"></i>
                            </a>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    @endforeach
</div>
    </div>
</section>
@endif

<!-- CATEGORIES SECTION -->
<section class="py-6 bg-white">
    <div class="container">
        <div class="text-center mb-6">
            <h6 class="text-primary text-uppercase fw-bold ls-2 mb-3">Our Categories</h6>
            <h2 class="display-5 fw-bold text-slate-900">Premium Collections</h2>
            <div class="title-line mx-auto mt-3"></div>
        </div>
        
        <div class="row g-4 justify-content-center">
            @php
                $cats = [
                    ['name' => 'MSM Course', 'icon' => 'fe-book-open', 'route' => 'module.msm', 'slug' => 'msm-course', 'color' => '#6366f1'],
                    ['name' => 'Gadgets', 'icon' => 'fe-smartphone', 'route' => 'module.gadgets', 'slug' => 'gadget', 'color' => '#10b981'],
                    ['name' => 'Digital', 'icon' => 'fe-cpu', 'route' => 'module.digital', 'slug' => 'digital', 'color' => '#0ea5e9'],
                    ['name' => 'Antique', 'icon' => 'fe-package', 'route' => 'module.antique', 'slug' => 'antique', 'color' => '#f59e0b']
                ];
            @endphp
            @foreach($cats as $cat)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route($cat['route']) }}" class="text-decoration-none group">
                    <div class="card h-100 border-0 shadow-sm category-card text-center py-4">
                        <div class="icon-box mb-3 mx-auto" style="background-color: {{ $cat['color'] }}15; color: {{ $cat['color'] }};">
                            <i class="fe {{ $cat['icon'] }} fs-28"></i>
                        </div>
                        <h6 class="fw-bold text-slate-700 group-hover-white mb-0">{{ $cat['name'] }}</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- MEDIA HIGHLIGHTS SECTION -->
<section class="py-6 bg-slate-50">
    <div class="container">
        @if($posters->count() > 0 || $videos->count() > 0)
            <div class="text-center mb-6">
                <h6 class="text-primary text-uppercase fw-bold ls-2 mb-3">Featured Highlights</h6>
                <h2 class="display-5 fw-bold text-slate-900">Posters & Videos</h2>
                <div class="title-line mx-auto mt-3"></div>
            </div>

            <!-- Posters Row -->
            @if($posters->count() > 0)
            <div class="row g-4 mb-5 justify-content-center">
                @foreach($posters as $poster)
                <div class="col-12 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden premium-media-card rounded-24">
                        <div class="media-img-wrapper position-relative" style="height: 380px; overflow: hidden; border-radius: 24px;">
                            @if($poster->link)
                                <a href="{{ $poster->link }}" target="_blank">
                            @endif
                            <img src="{{ asset($poster->file_path) }}" class="w-100 h-100" alt="{{ $poster->title }}" style="object-fit: cover; transition: transform 0.5s ease;">
                            @if($poster->title)
                                <div class="media-title-overlay position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, transparent 100%);">
                                    <h4 class="text-white fw-bold mb-0">{{ $poster->title }}</h4>
                                </div>
                            @endif
                            @if($poster->link)
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Videos Row -->
            @if($videos->count() > 0)
            <div class="row g-4 justify-content-center">
                @foreach($videos as $video)
                <div class="col-12 col-md-6">
                    <div class="card border-0 shadow-sm overflow-hidden premium-media-card rounded-24 bg-white p-3">
                        <div class="video-wrapper position-relative rounded-16 overflow-hidden" style="height: 320px; background: #0f172a; border-radius: 16px;">
                            <video class="w-100 h-100" controls style="object-fit: cover;">
                                <source src="{{ asset($video->file_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @if($video->title)
                            <div class="pt-3">
                                <h5 class="fw-bold text-slate-900 mb-1 px-1">{{ $video->title }}</h5>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        @else
            <div class="text-center mb-6">
                <h6 class="text-primary text-uppercase fw-bold ls-2 mb-3">Featured Highlights</h6>
                <h2 class="display-5 fw-bold text-slate-900">Posters & Videos</h2>
                <div class="title-line mx-auto mt-3"></div>
            </div>
            <div class="col-12 text-center py-6">
                <div class="empty-state">
                    <i class="fe fe-video display-1 text-slate-200 mb-4"></i>
                    <h3 class="text-slate-800 fw-bold">No Media Found</h3>
                    <p class="text-slate-500 mb-4">Please add posters and videos from the admin panel to display them here.</p>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- QUICK REQUEST FORM SECTION -->
<section class="custom-sourcing-section py-5 py-lg-6 position-relative overflow-hidden">
    <div class="container position-relative z-index-2">
        <div class="row align-items-center g-4 g-lg-5">
            
            <!-- LEFT SIDE: TEXT CONTENT -->
            <div class="col-12 col-lg-6">
                <div class="sourcing-content-wrapper text-center text-lg-start">
                    <h6 class="text-accent-blue text-uppercase fw-bold tracking-wider mb-2">
                        Custom Sourcing
                    </h6>
                    <h2 class="display-5 fw-extrabold text-slate-900 mb-3">
                        Still searching for <span class="text-accent-blue">something?</span>
                    </h2>
                    <p class="fs-16 text-slate-600 mb-4 max-w-xl mx-auto mx-lg-0">
                        Tell us what you need. Our team will hunt down the perfect gadget, course, or antique for you.
                    </p>
                    
                    <!-- Feature Indicators with Balanced Gaps -->
                    <div class="row g-3 justify-content-center justify-content-lg-start mt-2">
                        <div class="col-6 col-sm-5 col-md-4 col-lg-5">
                            <div class="feature-badge-item d-flex align-items-center justify-content-center justify-content-lg-start">
                                <div class="badge-icon-box me-2"><i class="fe fe-zap"></i></div>
                                <span class="fw-bold text-slate-800 fs-15">Fast Response</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-5 col-md-4 col-lg-5">
                            <div class="feature-badge-item d-flex align-items-center justify-content-center justify-content-lg-start">
                                <div class="badge-icon-box me-2"><i class="fe fe-shield"></i></div>
                                <span class="fw-bold text-slate-800 fs-15">Verified Items</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- RIGHT SIDE: CLEAN FORM CARD WITH BOX SHADOW -->
            <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                <div class="clean-white-card p-4 p-md-5">
                    <h3 class="fw-bold text-slate-900 mb-4 text-center text-md-start fs-22">
                        Send Your Request
                    </h3>

                    <!-- Alert Notifications -->
                    @if(session('t-success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-12 mb-4 d-flex align-items-center animate__animated animate__fadeIn" role="alert" style="background-color: #ecfdf5; color: #065f46; border-radius: 12px;">
                            <div class="me-2 d-flex align-items-center justify-content-center rounded-circle" style="width: 32px; height: 32px; background-color: #d1fae5;">
                                <i class="fe fe-check-circle fs-16" style="color: #10b981;"></i>
                            </div>
                            <div class="small">
                                <strong>Success!</strong> {{ session('t-success') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(30%) sepia(20%) saturate(1000%) hue-rotate(120deg);"></button>
                        </div>
                    @endif

                    @if(session('t-error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-12 mb-4 d-flex align-items-center animate__animated animate__fadeIn" role="alert" style="background-color: #fef2f2; color: #991b1b; border-radius: 12px;">
                            <div class="me-2 d-flex align-items-center justify-content-center rounded-circle" style="width: 32px; height: 32px; background-color: #fee2e2;">
                                <i class="fe fe-alert-circle fs-16" style="color: #ef4444;"></i>
                            </div>
                            <div class="small">
                                <strong>Error!</strong> {{ session('t-error') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(30%) sepia(20%) saturate(1000%) hue-rotate(340deg);"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-12 mb-4 animate__animated animate__fadeIn" role="alert" style="background-color: #fef2f2; color: #991b1b; border-radius: 12px;">
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(30%) sepia(20%) saturate(1000%) hue-rotate(340deg);"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="clean-form-label mb-1">Your Name</label>
                                <input type="text" name="name" class="form-control clean-input" placeholder="Enter name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="clean-form-label mb-1">Phone Number</label>
                                <input type="text" name="phone" class="form-control clean-input" placeholder="01XXXXXXXXX" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="clean-form-label mb-1">Item Description</label>
                                <textarea name="message" class="form-control clean-input" rows="4" placeholder="Tell us what you are looking for..." required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-clean-submit w-100 py-3 fw-bold">
                                    Submit Inquiry
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- DYNAMIC COLLAPSIBLE FAQ SECTION -->
@if(count($faqs) > 0)
<section class="py-6 bg-white position-relative overflow-hidden faq-section border-top">
    <div class="container position-relative z-index-2">
        <div class="text-center mb-6">
            <h6 class="text-primary text-uppercase fw-bold ls-2 mb-3">Frequently Asked Questions</h6>
            <h2 class="display-5 fw-extrabold text-slate-900">Have any <span class="text-accent-blue">Questions?</span></h2>
            <div class="title-line mx-auto mt-3"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="accordion accordion-flush premium-faq-accordion" id="faqAccordion">
                    @foreach($faqs as $key => $faq)
                    <div class="accordion-item mb-3 border-0 rounded-16 shadow-sm overflow-hidden">
                        <h2 class="accordion-header" id="headingFAQ{{ $faq->id }}">
                            <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }} fw-bold text-slate-800" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFAQ{{ $faq->id }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapseFAQ{{ $faq->id }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapseFAQ{{ $faq->id }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="headingFAQ{{ $faq->id }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-slate-600 bg-slate-50 fs-15">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Custom FAQ styling -->
<style>
    .faq-section {
        background-color: #ffffff !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .premium-faq-accordion .accordion-item {
        border: 1px solid #e2e8f0 !important;
        transition: all 0.3s ease;
    }

    .premium-faq-accordion .accordion-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.05), 
                    0 4px 6px -2px rgba(15, 23, 42, 0.05) !important;
        border-color: var(--primary) !important;
    }

    .premium-faq-accordion .accordion-button {
        padding: 20px 24px;
        font-size: 16px;
        background-color: #ffffff !important;
        color: var(--slate-900) !important;
        box-shadow: none !important;
        transition: all 0.3s ease;
    }

    .premium-faq-accordion .accordion-button:not(.collapsed) {
        color: var(--accent-blue) !important;
        background-color: rgba(37, 99, 235, 0.03) !important;
    }

    .premium-faq-accordion .accordion-button::after {
        background-size: 14px;
        transition: transform 0.3s ease;
    }

    .premium-faq-accordion .accordion-body {
        padding: 24px;
        line-height: 1.7;
        border-top: 1px solid #f1f5f9;
    }

    .rounded-16 {
        border-radius: 16px !important;
    }
</style>
@endif

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --bg-light-gray: #f8fafc; 
        --slate-900: #0f172a;    
        --slate-800: #1e293b;    
        --slate-600: #475569;    
        --accent-blue: #2563eb;  
        --accent-blue-hover: #1d4ed8;
    }

    .custom-sourcing-section {
        background-color: var(--bg-light-gray) !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .fw-extrabold { font-weight: 800 !important; }
    .tracking-wider { letter-spacing: 1px; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-600 { color: var(--slate-600) !important; }
    .text-accent-blue { color: var(--accent-blue) !important; }
    
    .fs-15 { font-size: 15px; }
    .fs-16 { font-size: 16px; line-height: 1.6; }
    .fs-22 { font-size: 22px; }
    .max-w-xl { max-width: 520px; }
    .z-index-2 { z-index: 2; }

    .badge-icon-box {
        color: var(--accent-blue);
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    /* PREMIUM BOX SHADOW ADDED HERE */
    .clean-white-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        /* মাল্টি-লেয়ার প্রফেশনাল শ্যাডো যা কার্ডটিকে চমৎকার গভীরতা দেয় */
        box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.03), 
                    0 20px 40px -4px rgba(15, 23, 42, 0.06) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* হালকা মাউস হোভার ইফেক্ট */
    .clean-white-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.03), 
                    0 24px 48px -4px rgba(15, 23, 42, 0.09) !important;
    }

    .clean-form-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--slate-800);
    }

    .clean-input {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: var(--slate-900) !important;
        font-size: 14px;
        font-weight: 500;
        padding: 12px 16px;
        border-radius: 8px !important;
        transition: all 0.2s ease;
    }

    .clean-input::placeholder {
        color: #94a3b8;
    }

    .clean-input:focus {
        border-color: var(--accent-blue) !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        outline: none;
    }

    .btn-clean-submit {
        background-color: var(--accent-blue);
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 700;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
    }

    .btn-clean-submit:hover {
        background-color: var(--accent-blue-hover);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25);
    }

    @media (max-width: 991px) {
        .sourcing-content-wrapper {
            margin-bottom: 20px;
        }
        .feature-badge-item {
            margin-bottom: 5px;
        }
    }

    @media (max-width: 575px) {
        .display-5 {
            font-size: 28px !important;
        }
        .clean-white-card {
            padding: 24px 16px !important;
        }
    }
</style>

<style>
    :root {
        --primary: #6366f1;
        --navy: #0f172a;
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #334155;
        --slate-500: #64748b;
        --slate-400: #94a3b8;
        --slate-200: #e2e8f0;
        --slate-50: #f8fafc;
    }

    /* GLOBAL UTILS */
    .py-6 { padding-top: 5rem; padding-bottom: 5rem; }
    .mb-6 { margin-bottom: 4rem; }
    .ls-2 { letter-spacing: 2px; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-700 { color: var(--slate-700) !important; }
    .text-slate-500 { color: var(--slate-500) !important; }
    .text-slate-400 { color: var(--slate-400) !important; }
    .bg-slate-50 { background-color: var(--slate-50) !important; }
    .bg-navy { background-color: var(--navy) !important; }
    .z-index-2 { z-index: 2; }
    .opacity-90 { opacity: 0.9; }

    /* BANNER */
    .banner-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to right, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 100%);
        z-index: 1;
    }
    .banner-img {
        height: 650px;
        object-fit: cover;
    }
    @media (max-width: 991px) {
        .banner-img { height: 450px; }
        .main-title { font-size: 2.5rem !important; }
        .sub-title { font-size: 1.1rem !important; }
    }
    @media (max-width: 576px) {
        .banner-img { height: 350px; }
        .main-title { font-size: 2rem !important; }
        .display-4 { font-size: 1.8rem !important; }
        .display-5 { font-size: 1.5rem !important; }
        .py-6 { padding-top: 3rem; padding-bottom: 3rem; }
    }
    .main-title { text-shadow: 0 4px 12px rgba(0,0,0,0.3); }
    .explore-btn:hover { transform: translateY(-3px) scale(1.05); }

    /* CATEGORIES */
    .title-line { width: 60px; height: 4px; background: var(--primary); border-radius: 10px; }
    .category-card {
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        background: #fff;
    }
    .category-card:hover {
        background: var(--primary) !important;
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
    }
    .icon-box {
        width: 64px; height: 64px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 16px; transition: all 0.3s ease;
    }
    .category-card:hover .icon-box {
        background-color: rgba(255,255,255,0.2) !important;
        color: #fff !important;
    }
    .category-card:hover h6 { color: #fff !important; }

    /* FILTER PILLS */
    .pill {
        padding: 8px 24px;
        border-radius: 50px;
        background: #fff;
        color: var(--slate-700);
        text-decoration: none;
        white-space: nowrap;
        margin-right: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 1px solid var(--slate-200);
    }
    .pill:hover, .pill.active {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
    }

    /* PRODUCT CARD */
    .product-card {
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important;
    }
    .product-img-wrapper {
        position: relative;
        height: 240px;
        overflow: hidden;
    }
    .product-img-wrapper img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.5s ease;
    }
    .product-card:hover .product-img-wrapper img { transform: scale(1.1); }
    .badge-discount {
        position: absolute; top: 15px; right: 15px;
        background: #ef4444; color: #fff;
        padding: 4px 12px; border-radius: 50px;
        font-weight: 700; font-size: 12px;
    }
    .product-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.4);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease;
    }
    .product-card:hover .product-overlay { opacity: 1; }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .btn-navy-soft {
        background: rgba(15, 23, 42, 0.05);
        color: var(--navy);
    }
    .btn-navy-soft:hover {
        background: var(--navy);
        color: #fff;
    }

    /* GLASS CARD */
    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 32px;
    }
    .glass-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff !important;
        border-radius: 12px;
        padding: 12px 16px;
    }
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--primary);
        box-shadow: none;
    }
    .glass-input::placeholder { color: rgba(255, 255, 255, 0.4); }
    .footer-glow {
        position: absolute; bottom: -100px; right: -100px;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }
</style>

<!-- Premium Global Banner Layout Architecture Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* Design Token System */
    .custom-premium-slider {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    .fw-black { font-weight: 800; }
    .text-white-90 { color: rgba(255, 255, 255, 0.9) !important; }
    .bg-white-soft { background-color: rgba(255, 255, 255, 0.12) !important; }
    .border-white-10 { border-color: rgba(255, 255, 255, 0.18) !important; }
    .tracking-wider { letter-spacing: 0.05em; }
    .fs-11 { font-size: 11px; }
    .fs-16 { font-size: 16px; }
    .max-w-600 { max-width: 600px; }
    .text-balance { text-wrap: balance; }

    /* ==========================================================================
       Banners Image Shield (ব্যাকএন্ডের ইমেজ পারফেক্ট রাখার মূল সিক্রেট)
       ========================================================================== */
    .banner-image-container {
        position: relative;
        width: 100%;
        height: 620px; /* Desktop Perfect Standard Aspect Ratio Frame */
        background-color: #0f172a; /* Fallback skeleton color */
    }
    
    .banner-img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important; /* ইমেজ চ্যাপ্টা না করে পুরো কন্টেইনারে নিখুঁতভাবে ফিট করবে */
        object-position: center !important; /* ফোকাস সবসময় ইমেজের মাঝখানে রাখবে */
    }

    /* Cinematic Dark Gradient Mask Overlay (টেক্সট ফুটিয়ে তোলার জন্য) */
    .banner-overlay-gradient {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(90deg, rgba(15, 23, 42, 0.75) 0%, rgba(15, 23, 42, 0.4) 50%, rgba(15, 23, 42, 0.1) 100%);
        pointer-events: none;
    }

    /* Modern Layout Captions Restyling */
    .custom-caption-alignment {
        top: 0; left: 0; right: 0; bottom: 0;
        padding: 0 !important;
        margin: 0 !important;
        display: flex;
        align-items: center; /* Vertically Centers text alignment on all screens */
    }

    /* Premium Clean White Glass Button */
    .btn-premium-white {
        background-color: #ffffff;
        color: #0f172a !important;
        border: 1px solid #ffffff;
        font-size: 15px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-premium-white:hover {
        background-color: transparent;
        color: #ffffff !important;
    }
    
    /* Micro Animations */
    .transition-arrow { transition: transform 0.2s ease; display: inline-block; }
    .btn-premium-white:hover .transition-arrow { transform: translateX(4px); }
    .hover-scale { transition: transform 0.2s ease; }
    .hover-scale:hover { transform: translateY(-2px); }

    .pulse-dot {
        width: 6px; height: 6px; background-color: #22c55e; border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        animation: active-pulse 2s infinite;
    }
    @keyframes active-pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 5px rgba(34, 197, 94, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
    }

    /* ==========================================================================
       Ultra Responsive Mobile Fluid Matrix (মোবাইলে ব্যানার সুন্দর করার নিয়ম)
       ========================================================================== */
    @media (max-width: 991.98px) {
        .banner-image-container { height: 480px; } /* Tablet View Frame Aspect */
        .display-3 { font-size: 2.5rem !important; }
    }

    @media (max-width: 576px) {
        .banner-image-container { 
            height: 380px; /* Mobile View Compact Frame Aspect */
        }
        .banner-overlay-gradient {
            background: rgba(15, 23, 42, 0.65); /* Full dark mask layer on small phone monitors */
        }
        .display-3 { 
            font-size: 1.85rem !important; 
            line-height: 1.25 !important;
        }
        .sub-title { 
            font-size: 0.95rem !important; 
            line-height: 1.5 !important;
            opacity: 0.85;
        }
        .btn-premium-white {
            padding: 0.65rem 1.25rem !important;
            font-size: 14px;
        }
    }

    /* Premium Media Card Styles */
    .premium-media-card {
        border-radius: 24px !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.03), 
                    0 20px 40px -4px rgba(15, 23, 42, 0.06) !important;
    }
    .premium-media-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.05), 
                    0 24px 48px -4px rgba(15, 23, 42, 0.09) !important;
    }
    .media-img-wrapper:hover img {
        transform: scale(1.05);
    }
    .rounded-24 {
        border-radius: 24px !important;
    }
    .rounded-16 {
        border-radius: 16px !important;
    }
</style>
@endsection