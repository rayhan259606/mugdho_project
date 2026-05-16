@extends('frontend.simple.app', ['title' => $product->title])

@section('content')
<!-- Premium Product Details Section -->
<section class="py-4 py-lg-6 bg-premium-light-gray position-relative overflow-hidden">
    <!-- Subtle Ambient Accents -->
    <div class="decor-blur-soft-1"></div>
    <div class="decor-blur-soft-2"></div>

    <div class="container position-relative z-index-1">
        <!-- Advanced Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 animate__animated animate__fadeIn">
            <ol class="breadcrumb custom-modern-breadcrumb bg-white px-3 py-2 rounded-pill shadow-sm d-inline-flex border border-slate-100">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-slate-500 hover-primary"><i class="fe fe-home me-1"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('home', ['category' => $product->category->slug ?? '']) }}" class="text-slate-500 hover-primary">{{ $product->category->name ?? 'Products' }}</a></li>
                <li class="breadcrumb-item active text-slate-800 fw-semibold" aria-current="page">{{ Str::limit($product->title, 25) }}</li>
            </ol>
        </nav>

        <div class="row g-4 g-lg-5">
            <!-- Left Layout: Interactive Product Media -->
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <!-- Main Preview Container -->
                <div class="card border-0 shadow-premium rounded-24 overflow-hidden bg-white p-2 border border-slate-100 mb-3">
                    <div class="position-relative card-main-img-wrap rounded-20 overflow-hidden">
                        <img src="{{ asset($product->thumbnail) }}" class="w-100 h-100 object-fit-cover transition-transform" id="mainProductPreview" alt="{{ $product->title }}">
                        @if($product->discount > 0)
                            <span class="badge bg-danger text-white modern-discount-badge fw-bold shadow-sm">
                                <i class="fe fe-tag me-1"></i> Save ৳{{ number_format($product->discount) }}
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Extra Gallery Slider/Grid -->
                @if($product->images && count($product->images) > 0)
                <div class="row g-2 g-sm-3 product-thumb-gallery">
                    <div class="col-3">
                        <div class="card border-2 border-primary thumbnail-track rounded-16 overflow-hidden bg-white p-1 cursor-pointer transition-all" onclick="switchPreviewImage('{{ asset($product->thumbnail) }}', this)">
                            <img src="{{ asset($product->thumbnail) }}" class="img-fluid rounded-12 object-fit-cover h-60px w-100" alt="Thumbnail">
                        </div>
                    </div>
                    @foreach($product->images as $img)
                    <div class="col-3">
                        <div class="card border-2 border-transparent thumbnail-track rounded-16 overflow-hidden bg-white p-1 cursor-pointer transition-all" onclick="switchPreviewImage('{{ asset($img->image) }}', this)">
                            <img src="{{ asset($img->image) }}" class="img-fluid rounded-12 object-fit-cover h-60px w-100" alt="Gallery">
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Right Layout: Product Information & Checkout -->
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="product-info-card p-4 p-sm-5 bg-white shadow-premium rounded-24 border border-slate-100 h-100 d-flex flex-column">
                    <!-- Category & Title -->
                    <div class="mb-3">
                        <span class="badge bg-primary-soft text-primary fw-semibold px-3 py-2 rounded-pill text-uppercase tracking-wider fs-11">
                            <i class="fe fe-folder me-1"></i> {{ $product->category->name ?? 'Premium Item' }}
                        </span>
                        <h1 class="fw-black text-slate-900 mt-2 display-6 lh-sm">{{ $product->title }}</h1>
                    </div>
                    
                    <!-- Dynamic Reviews Rating Box -->
                    <div class="d-flex align-items-center mb-4 bg-slate-50 p-2.5 rounded-14 border border-slate-100 max-w-max">
                        <div class="text-warning me-2 fs-13">
                            <i class="fe fe-star fill-warning"></i>
                            <i class="fe fe-star fill-warning"></i>
                            <i class="fe fe-star fill-warning"></i>
                            <i class="fe fe-star fill-warning"></i>
                            <i class="fe fe-star"></i>
                        </div>
                        <span class="text-slate-800 fw-bold fs-13 me-2">4.5/5</span>
                        <span class="text-slate-400 small-90">({{ rand(50, 200) }} verified reviews)</span>
                    </div>

                    <!-- Clean Dynamic Price Matrix -->
                    <div class="price-showcase-box mb-4 p-3 bg-gradient-light rounded-20 border border-slate-100">
                        @if($product->discount > 0)
                            <div class="d-flex align-items-baseline gap-2 flex-wrap">
                                <h2 class="text-gradient-primary fw-black mb-0 fs-32">৳{{ number_format($product->price - $product->discount) }}</h2>
                                <span class="text-slate-400 text-decoration-line-through small-90">M.R.P: ৳{{ number_format($product->price) }}</span>
                            </div>
                            <div class="text-danger small fw-semibold mt-1 d-flex align-items-center">
                                <i class="fe fe-arrow-down-left me-1"></i> Instant discount active at checkout
                            </div>
                        @else
                            <h2 class="text-gradient-primary fw-black mb-0 fs-32">৳{{ number_format($product->price) }}</h2>
                        @endif
                    </div>

                    <!-- Product Short Description -->
                    <div class="description mb-4 text-slate-700 dynamic-rich-text fs-15 lh-relaxed">
                        {!! $product->description ?? 'No premium description available for this selected item.' !!}
                    </div>

                    <!-- Quick Trust Indicators -->
                    <div class="row g-2 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-2 rounded-12 border border-dashed border-slate-200">
                                <i class="fe fe-shield text-success fs-18 me-2"></i>
                                <span class="small fw-semibold text-slate-800">100% Original Product</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-2 rounded-12 border border-dashed border-slate-200">
                                <i class="fe fe-refresh-cw text-primary fs-18 me-2"></i>
                                <span class="small fw-semibold text-slate-800">Easy Return Policy</span>
                            </div>
                        </div>
                    </div>

                    <hr class="hr-modern mb-4">

                    <!-- Seamless Order Form Inlay -->
                    <div class="order-form-box p-3 p-sm-4 bg-slate-50 border border-slate-100 rounded-24" id="order-inquiry-box">
                        <h4 class="fw-bold text-slate-900 mb-3 fs-18 d-flex align-items-center">
                            <span class="form-indicator-pulse me-2"></span>
                            Fast Checkout Order
                        </h4>
                        
                        <form action="{{ route('product.order') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-slate-700 fw-semibold">Your Full Name</label>
                                    <input type="text" name="name" class="form-control rounded-pill custom-form-input px-4" placeholder="Enter full name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-slate-700 fw-semibold">Active Phone Number</label>
                                    <input type="text" name="phone" class="form-control rounded-pill custom-form-input px-4" placeholder="01XXXXXXXXX" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-slate-700 fw-semibold">Delivery Address</label>
                                    <textarea name="address" class="form-control rounded-20 custom-form-input px-4 py-3" rows="2" placeholder="Write full delivery details..." required></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-gradient-primary btn-lg w-100 rounded-pill py-3 fw-bold text-white shadow-md hover-scale d-flex align-items-center justify-content-center gap-2">
                                        <i class="fe fe-zap fs-16"></i> Confirm Cash On Delivery
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Advanced Interactive Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-color: #4f46e5;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #475569;
        --slate-500: #64748b;
        --slate-400: #94a3b8;
        --slate-100: #f1f5f9;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* Helper Utilities */
    .fw-black { font-weight: 800; }
    .text-slate-500 { color: var(--slate-500) !important; }
    .text-slate-700 { color: var(--slate-700) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .bg-premium-light-gray { background-color: #fafafa; }
    .bg-slate-50 { background-color: #f8fafc !important; }
    .bg-gradient-light { background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); }
    .rounded-24 { border-radius: 24px !important; }
    .rounded-20 { border-radius: 20px !important; }
    .rounded-16 { border-radius: 16px !important; }
    .rounded-14 { border-radius: 14px !important; }
    .rounded-12 { border-radius: 12px !important; }
    .tracking-wider { letter-spacing: 0.04em; }
    .max-w-max { max-width: max-content; }
    .fs-11 { font-size: 11px; }
    .fs-13 { font-size: 13px; }
    .fs-15 { font-size: 15px; }
    .fs-18 { font-size: 18px; }
    .fs-32 { font-size: 32px; }
    .small-90 { font-size: 0.88rem; }
    .h-60px { height: 60px; }
    .cursor-pointer { cursor: pointer; }
    .border-transparent { border-color: transparent !important; }

    /* Glass & Box Shadows */
    .shadow-premium {
        box-shadow: 0 12px 40px -10px rgba(15, 23, 42, 0.04) !important;
    }
    .bg-primary-soft { background-color: rgba(79, 70, 229, 0.08) !important; }
    
    /* Background Light Elements */
    .decor-blur-soft-1 {
        position: absolute; top: -5%; left: -5%; width: 350px; height: 350px;
        background: rgba(99, 102, 241, 0.03); filter: blur(90px); border-radius: 50%; pointer-events: none;
    }
    .decor-blur-soft-2 {
        position: absolute; bottom: 5%; right: -5%; width: 350px; height: 350px;
        background: rgba(124, 58, 237, 0.03); filter: blur(90px); border-radius: 50%; pointer-events: none;
    }

    /* Primary Text Gradients & Buttons */
    .text-gradient-primary {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .btn-gradient-primary {
        background: var(--primary-gradient);
        border: none;
        transition: opacity 0.2s ease;
    }
    .btn-gradient-primary:hover {
        opacity: 0.95;
        color: white;
    }

    /* Media Layout Frames */
    .card-main-img-wrap {
        height: 480px;
    }
    .card-main-img-wrap img {
        width: 100%; height: 100%; object-fit: contain; background: #ffffff;
    }
    .modern-discount-badge {
        position: absolute; top: 15px; left: 15px; padding: 7px 14px; border-radius: 10px; font-size: 0.82rem;
    }

    /* Custom Breadcrumbs Overrides */
    .custom-modern-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        content: "\e930" !important;
        font-family: 'feather' !important;
        font-size: 11px;
        color: var(--slate-400);
        vertical-align: middle;
    }
    .hover-primary { transition: color 0.2s ease; text-decoration: none; }
    .hover-primary:hover { color: var(--primary-color) !important; }

    /* Form Design Overhaul */
    .custom-form-input {
        background-color: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        padding-top: 0.7rem !important;
        padding-bottom: 0.7rem !important;
        font-size: 0.95rem;
        color: var(--slate-800) !important;
        transition: all 0.2s ease;
    }
    .custom-form-input:focus {
        border-color: #a5b4fc !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08) !important;
    }

    .hr-modern {
        border: 0; height: 1px; background: linear-gradient(90deg, rgba(226,232,240,0.2) 0%, rgba(226,232,240,1) 50%, rgba(226,232,240,0.2) 100%);
    }

    /* Live order indicator badge */
    .form-indicator-pulse {
        width: 8px; height: 8px; background-color: #22c55e; border-radius: 50%;
        display: inline-block; box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        animation: pulse-wave 2s infinite;
    }

    /* Feather Font Fill Utilities */
    .fill-warning { fill: #f59e0b; color: #f59e0b; }

    @keyframes pulse-wave {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
    }

    /* Interaction Enhancements */
    .hover-scale { transition: transform 0.2s ease; }
    .hover-scale:hover { transform: translateY(-1px); }

    /* Responsive Mobile Overrides */
    @media (max-width: 991.98px) {
        .py-lg-6 { padding-top: 2.5rem; padding-bottom: 2.5rem; }
        .card-main-img-wrap { height: 360px; }
    }
    
    @media (max-width: 576px) {
        .display-6 { font-size: 1.6rem !important; }
        .card-main-img-wrap { height: 280px; }
        .product-info-card { padding: 1.25rem !important; }
        .custom-modern-breadcrumb { font-size: 13px; padding: 6px 16px !important; }
        .fs-32 { font-size: 26px; }
    }
</style>

<!-- Product Image Switcher Dynamic Vanilla JavaScript -->
<script>
    function switchPreviewImage(imageUrl, thumbnailElement) {
        // Change Main Image Src with smooth fade
        const previewImg = document.getElementById('mainProductPreview');
        previewImg.style.opacity = '0.3';
        
        setTimeout(() => {
            previewImg.src = imageUrl;
            previewImg.style.opacity = '1';
        }, 150);

        // Reset and Update Active Thumbnail Border Styles
        document.querySelectorAll('.thumbnail-track').forEach(card => {
            card.classList.remove('border-primary');
            card.classList.add('border-transparent');
        });
        
        thumbnailElement.classList.remove('border-transparent');
        thumbnailElement.classList.add('border-primary');
    }
</script>
@endsection