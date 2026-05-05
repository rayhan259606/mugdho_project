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
        <div class="carousel-inner">
            @foreach($banners as $key => $banner)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <div class="banner-overlay"></div>
                <img src="{{ asset($banner->image) }}" class="d-block w-100 banner-img" alt="{{ $banner->title }}">
                <div class="carousel-caption d-md-block text-start animate__animated animate__fadeInUp">
                    <div class="container">
                        <div class="col-lg-8">
                            <h1 class="display-2 fw-bold mb-3 text-white main-title">{{ $banner->title }}</h1>
                            <p class="fs-4 mb-5 text-light opacity-90 sub-title">{{ $banner->subtitle }}</p>
                            @if($banner->link)
                            <a href="{{ $banner->link }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg border-0 explore-btn">
                                Explore Now <i class="fe fe-arrow-right ms-2"></i>
                            </a>
                            @endif
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
                    ['name' => 'Antique', 'icon' => 'fe-package', 'route' => 'module.antique', 'slug' => 'antique', 'color' => '#f59e0b'],
                    ['name' => 'Services', 'icon' => 'fe-briefcase', 'route' => 'module.services', 'slug' => 'business-services', 'color' => '#ef4444'],
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

<!-- PRODUCTS GRID -->
<section class="py-6 bg-slate-50">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
            <div class="mb-4 mb-md-0">
                <h2 class="fw-bold text-dark display-6 mb-1">Featured Items</h2>
                <p class="text-secondary mb-0">Handpicked items just for you</p>
            </div>
            <div class="filter-pills d-flex overflow-auto pb-2">
                <a href="{{ route('home') }}" class="pill {{ !request('category') ? 'active' : '' }}">All Items</a>
                @foreach($cats as $cat)
                    <a href="{{ route('home', ['category' => $cat['slug']]) }}" class="pill {{ request('category') == $cat['slug'] ? 'active' : '' }}">{{ $cat['name'] }}</a>
                @endforeach
            </div>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset($product->thumbnail) }}" class="card-img-top" alt="{{ $product->title }}">
                        @if($product->discount > 0)
                        <span class="badge-discount">-${{ $product->discount }}</span>
                        @endif
                        <div class="product-overlay">
                            <a href="{{ route('product.details', $product->slug) }}" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm">View Details</a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-primary small fw-bold mb-1">{{ $product->category->name ?? 'Collection' }}</p>
                        <h5 class="card-title fw-bold text-dark mb-3 text-truncate-2">{{ $product->title }}</h5>
                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <div class="price-stack">
                                @if($product->discount > 0)
                                <span class="old-price text-secondary text-decoration-line-through small d-block">${{ $product->price }}</span>
                                <span class="current-price text-dark fw-bold fs-5">${{ $product->price - $product->discount }}</span>
                                @else
                                <span class="current-price text-dark fw-bold fs-5">${{ $product->price }}</span>
                                @endif
                            </div>
                            <a href="{{ route('product.details', $product->slug) }}" class="btn btn-navy-soft btn-icon rounded-circle">
                                <i class="fe fe-shopping-bag"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-6">
                <div class="empty-state">
                    <i class="fe fe-package display-1 text-slate-200 mb-4"></i>
                    <h3 class="text-slate-800 fw-bold">Nothing found here</h3>
                    <p class="text-slate-500 mb-4">We couldn't find any items matching your selection.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-5 py-3">View All Products</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- QUICK REQUEST FORM SECTION -->
<section class="py-6 bg-navy text-white position-relative overflow-hidden">
    <div class="footer-glow"></div>
    <div class="container position-relative z-index-2">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase fw-bold ls-2 mb-3">Custom Sourcing</h6>
                <h2 class="display-4 fw-bold mb-4">Still searching for <span class="text-primary">something?</span></h2>
                <p class="fs-5 text-white-50 mb-5">Tell us what you need. Our team will hunt down the perfect gadget, course, or antique for you.</p>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-zap text-primary fs-24 me-3"></i>
                            <span class="fw-bold">Fast Response</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-shield text-primary fs-24 me-3"></i>
                            <span class="fw-bold">Verified Items</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 glass-card p-3 p-md-5">
                    <h3 class="fw-bold mb-4 text-white">Send Your Request</h3>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold opacity-75">Your Name</label>
                                <input type="text" name="name" class="form-control glass-input" placeholder="Enter name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold opacity-75">Phone Number</label>
                                <input type="text" name="phone" class="form-control glass-input" placeholder="01XXXXXXXXX" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold opacity-75">Item Description</label>
                                <textarea name="message" class="form-control glass-input" rows="3" placeholder="Tell us what you are looking for..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-lg shadow-primary-50">Submit Inquiry</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
@endsection