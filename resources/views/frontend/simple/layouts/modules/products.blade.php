@extends('frontend.simple.app', ['title' => $title])

@section('content')
<!-- Hero Section with Modern Background -->
<section class="py-5 py-lg-7 bg-premium-modern position-relative overflow-hidden">
    <!-- Sophisticated Abstract Ambient Light Blurs -->
    <div class="decor-blur-1"></div>
    <div class="decor-blur-2"></div>
    
    <div class="container position-relative z-index-1">
        <div class="row g-4 g-lg-5 align-items-center">
            <!-- Left Content -->
            <div class="col-lg-6 text-center text-lg-start">
                <span class="badge bg-primary-soft text-primary fw-semibold px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fs-12 border border-primary-100 animate__animated animate__fadeInDown">
                    <i class="fe fe-layers me-1"></i> Premium Collection
                </span>
                <h1 class="display-4 fw-black text-slate-900 mb-3 lh-sm animate__animated animate__fadeInUp">
                    {{ $title }}
                </h1>
                <p class="lead text-slate-700 mb-4 px-2 px-lg-0 mx-auto mx-lg-0 max-w-500 fw-medium animate__animated animate__fadeInUp animate__delay-1s">
                    Explore our handpicked selection of high-quality items. Whether you're looking for the latest tech or rare finds, we have something special for you.
                </p>
                
                <!-- Trust Badges -->
                <div class="d-flex flex-column gap-3 max-w-450 mx-auto mx-lg-0 mb-4 mb-lg-0 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="d-flex align-items-center bg-white p-3 rounded-16 shadow-premium border border-white">
                        <div class="stat-icon bg-primary-soft text-primary me-3">
                            <i class="fe fe-award fs-5"></i>
                        </div>
                        <span class="fw-bold text-slate-800 fs-15">Quality Guaranteed & Handpicked</span>
                    </div>
                    <div class="d-flex align-items-center bg-white p-3 rounded-16 shadow-premium border border-white">
                        <div class="stat-icon bg-success-soft text-success me-3">
                            <i class="fe fe-truck fs-5"></i>
                        </div>
                        <span class="fw-bold text-slate-800 fs-15">Fast & Secure Worldwide Shipping</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Inquiry Form -->
            <div class="col-lg-6">
                <div class="card border-0 modern-glass-card rounded-32 p-4 p-sm-5 mx-auto max-w-550">
                    <div class="text-center text-lg-start mb-4">
                        <h3 class="fw-bold text-slate-900 mb-1">Quick Order / Inquiry</h3>
                        <p class="text-slate-600 small mb-0">Drop your info and we will get back shortly.</p>
                    </div>

                    @if(session('t-success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert" style="background-color: #d1fae5; color: #065f46; border-color: #a7f3d0;">
                            <strong>Success!</strong> {{ session('t-success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('t-error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert" style="background-color: #fee2e2; color: #991b1b; border-color: #fecaca;">
                            <strong>Error!</strong> {{ session('t-error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert" style="background-color: #fee2e2; color: #991b1b; border-color: #fecaca;">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('product.order') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-slate-700 fw-semibold small">Select Item</label>
                                <div class="input-group-custom">
                                    <select name="product_id" class="form-select custom-input text-slate-800" required>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-slate-700 fw-semibold small">Your Name</label>
                                <input type="text" name="name" class="form-control custom-input" placeholder="Full Name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-slate-700 fw-semibold small">Phone</label>
                                <input type="text" name="phone" class="form-control custom-input" placeholder="01XXXXXXXXX" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-slate-700 fw-semibold small">Address</label>
                                <input type="text" name="address" class="form-control custom-input" placeholder="Shipping Address" value="{{ old('address') }}" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-gradient-primary w-100 rounded-pill py-3 fw-bold text-white shadow-md hover-scale">
                                    Confirm Inquiry <i class="fe fe-shopping-cart ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Grid Section -->
<section class="py-5 py-lg-6 bg-white">
    <div class="container">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h2 class="fw-bold text-slate-900 mb-2 section-title position-relative d-inline-block">Current Collection</h2>
            <p class="text-muted small">Discover our premium range of top tier products curated just for you.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 modern-product-card bg-white rounded-24 overflow-hidden">
                    <!-- Image Wrapper with Badges -->
                    <div class="position-relative overflow-hidden card-img-wrapper">
                        <img src="{{ asset($product->thumbnail) }}" class="card-img-top transition-transform" alt="{{ $product->title }}">
                        @if($product->discount > 0)
                            <span class="badge bg-danger text-white discount-tag fw-bold shadow-sm">
                                Save ৳{{ number_format($product->discount) }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Content Details -->
                    <div class="card-body p-4 d-flex flex-column">
                        <h6 class="fw-bold text-slate-800 mb-2 line-clamp-2 h-40px">{{ $product->title }}</h6>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                            <div class="d-flex flex-column">
                                @if($product->discount > 0)
                                    <span class="text-slate-400 text-decoration-line-through small-90">৳{{ number_format($product->price) }}</span>
                                @endif
                                <span class="text-primary fw-bold fs-16">৳{{ number_format($product->price - $product->discount) }}</span>
                            </div>
                            <a href="{{ route('product.details', $product->slug) }}" class="btn btn-outline-custom rounded-pill btn-sm px-3 fw-semibold transition-all">
                                View <i class="fe fe-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Custom Professional & Gorgeous Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-color: #4f46e5;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #475569;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* Modern Utilities */
    .fw-black { font-weight: 800; }
    .text-slate-700 { color: var(--slate-700) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .max-w-450 { max-width: 450px; }
    .max-w-500 { max-width: 500px; }
    .max-w-550 { max-width: 550px; }
    .max-w-600 { max-width: 600px; }
    .rounded-32 { border-radius: 32px !important; }
    .rounded-24 { border-radius: 24px !important; }
    .rounded-16 { border-radius: 16px !important; }
    .tracking-wider { letter-spacing: 0.05em; }
    .fs-12 { font-size: 12px; }
    .fs-15 { font-size: 15px; }
    .fs-16 { font-size: 16px; }
    .small-90 { font-size: 0.82rem; }
    .h-40px { height: auto; min-height: 40px; }

    /* Simple Yet Gorgeous Tech Blur Background */
    .bg-premium-modern {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    .decor-blur-1 {
        position: absolute;
        top: -10%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: rgba(99, 102, 241, 0.05);
        filter: blur(100px);
        border-radius: 50%;
        pointer-events: none;
    }
    .decor-blur-2 {
        position: absolute;
        bottom: -10%;
        right: 5%;
        width: 500px;
        height: 500px;
        background: rgba(124, 58, 237, 0.04);
        filter: blur(120px);
        border-radius: 50%;
        pointer-events: none;
    }

    /* Soft Badges, Buttons, & Gradient */
    .bg-primary-soft { background-color: rgba(79, 70, 229, 0.08) !important; }
    .bg-success-soft { background-color: rgba(34, 197, 94, 0.08) !important; }
    .border-primary-100 { border-color: rgba(99, 102, 241, 0.15) !important; }
    .btn-gradient-primary {
        background: var(--primary-gradient);
        border: none;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
        color: white;
    }

    .stat-icon {
        width: 40px; height: 40px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
    }

    /* Modern Glass Card Inquiry Form */
    .modern-glass-card {
        background: #ffffff !important;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.07) !important;
        border: 1px solid rgba(255, 255, 255, 0.8) !important;
    }
    .custom-input {
        background-color: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        padding: 0.75rem 1rem !important;
        border-radius: 14px !important;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    .custom-input:focus {
        background-color: #ffffff !important;
        border-color: #a5b4fc !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08) !important;
    }

    /* Modern Product Grid Cards */
    .modern-product-card {
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.02);
        border: 1px solid #f1f5f9 !important;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
    }
    .modern-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px rgba(15, 23, 42, 0.07);
    }
    .card-img-wrapper {
        height: 220px;
    }
    .card-img-wrapper img {
        width: 100%; height: 100%; object-fit: cover;
    }
    .modern-product-card:hover .card-img-wrapper img {
        transform: scale(1.06);
    }
    .transition-transform {
        transition: transform 0.5s ease;
    }
    .discount-tag {
        position: absolute;
        top: 15px; left: 15px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.78rem;
        letter-spacing: 0.02em;
    }

    /* View Arrow Buttons */
    .btn-outline-custom {
        color: var(--primary-color);
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
    }
    .btn-outline-custom:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    .hover-scale {
        transition: transform 0.2s ease;
    }
    .hover-scale:hover {
        transform: translateY(-2px);
    }

    /* Layout Alignments */
    .line-clamp-2 {
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .section-title::after {
        content: ''; position: absolute; bottom: -6px; left: 50%; transform: translateX(-50%);
        width: 40px; height: 3px; background: var(--primary-gradient); border-radius: 2px;
    }

    /* Mobile Fluid Responsiveness Queries */
    @media (max-width: 991.98px) {
        .py-lg-7 { padding-top: 4rem; padding-bottom: 4rem; }
        .display-4 { font-size: 2.25rem !important; }
    }
    @media (max-width: 576px) {
        .display-4 { font-size: 1.85rem !important; }
        .card-img-wrapper { height: 190px; }
        .card.p-sm-5 { padding: 1.25rem !important; }
        .modern-glass-card { border-radius: 24px !important; }
        .row.g-4 > [class*='col-'] { padding-left: 10px; padding-right: 10px; } /* মোবাইলে গ্রিড স্পেসিং পারফেক্ট রাখার জন্য */
    }
</style>
@endsection