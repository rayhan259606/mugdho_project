@extends('frontend.simple.app', ['title' => $title])

@section('content')
<!-- Hero Section with Dynamic CMS Layout -->
<section class="py-6 py-lg-8 bg-premium-modern position-relative overflow-hidden">
    <!-- Sophisticated Abstract Ambient Light Blurs -->
    <div class="decor-blur-1"></div>
    <div class="decor-blur-2"></div>
    <div class="hero-grid-overlay"></div>
    
    <div class="container position-relative z-index-2">
        <div class="row align-items-center justify-content-between">
            <div class="{{ !empty($pageCms?->image) ? 'col-lg-6 text-start' : 'col-lg-10 col-xl-8 mx-auto text-center' }}">
                <span class="badge bg-primary-soft text-primary fw-semibold px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fs-11 border border-primary-100 animate__animated animate__fadeInDown">
                    <i class="fe fe-layers me-1"></i> Premium Collection
                </span>
                <h1 class="display-3 fw-black text-slate-900 mb-4 lh-sm animate__animated animate__fadeInUp">
                    {{ $pageCms?->title ?? $title }}
                </h1>
                <p class="lead text-slate-700 mb-5 fw-medium animate__animated animate__fadeInUp animate__delay-1s">
                    {!! $pageCms?->description ?? "Explore our handpicked selection of high-quality items. Whether you're looking for the latest tech or rare finds, we have something special for you." !!}
                </p>
                
                <!-- Trust Badges -->
                <div class="row g-3 mt-4 animate__animated animate__fadeInUp animate__delay-2s {{ !empty($pageCms?->image) ? '' : 'justify-content-center max-w-600 mx-auto' }}">
                    <div class="col-12 col-sm-6">
                        <div class="d-flex align-items-center bg-white bg-opacity-80 backdrop-blur p-3 rounded-24 shadow-premium border border-white h-100 {{ !empty($pageCms?->image) ? '' : 'justify-content-center' }}">
                            <div class="stat-icon bg-primary-soft text-primary me-2.5">
                                <i class="fe fe-award fs-5"></i>
                            </div>
                            <span class="fw-bold text-slate-850 fs-12 text-start">{{ $pageCms?->metadata['feature_1_title'] ?? 'Quality Guaranteed & Handpicked' }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="d-flex align-items-center bg-white bg-opacity-80 backdrop-blur p-3 rounded-24 shadow-premium border border-white h-100 {{ !empty($pageCms?->image) ? '' : 'justify-content-center' }}">
                            <div class="stat-icon bg-success-soft text-success me-2.5">
                                <i class="fe fe-truck fs-5"></i>
                            </div>
                            <span class="fw-bold text-slate-850 fs-12 text-start">{{ $pageCms?->metadata['feature_2_title'] ?? 'Fast & Secure Worldwide Shipping' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($pageCms?->image))
            <div class="col-lg-5 mt-5 mt-lg-0 text-center animate__animated animate__fadeInRight">
                <div class="hero-image-wrapper rounded-32 overflow-hidden shadow-premium border border-white border-2">
                    <img src="{{ asset($pageCms?->image) }}" class="img-fluid" alt="Hero Image" style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Product Grid Section -->
<section class="py-6 bg-white position-relative">
    <div class="container">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h2 class="fw-bold text-slate-900 mb-2 section-title position-relative d-inline-block">Current Collection</h2>
            <p class="text-muted small">Discover our premium range of top tier products curated just for you.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 modern-product-card bg-white rounded-24 overflow-hidden">
                    <!-- Image Wrapper with Badges and Dual blur + object-fit contain display -->
                    <div class="position-relative overflow-hidden card-img-wrapper">
                        <div class="card-bg-blur" style="background-image: url('{{ asset($product->thumbnail) }}');"></div>
                        <img src="{{ asset($product->thumbnail) }}" class="card-img-top-custom" alt="{{ $product->title }}">
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
                                    <span class="text-slate-450 text-decoration-line-through small-90">৳{{ number_format($product->price) }}</span>
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

<!-- Order/Inquiry Form Section at the Bottom -->
<section id="enrollment-form-section" class="py-6 py-lg-8 bg-premium-form-modern position-relative overflow-hidden border-top">
    <div class="decor-glow-4"></div>
    <div class="decor-glow-5"></div>
    
    <div class="container position-relative z-index-2">
        <div class="max-w-650 mx-auto">
            <div class="card border-0 modern-glass-card rounded-32 p-4 p-md-5 shadow-premium">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-slate-900 mb-2">Secure Your Order</h2>
                    <p class="text-slate-600 small">Select your item and fill up the form below to submit inquiry or order.</p>
                </div>

                @if(session('t-success'))
                    <div class="alert alert-success p-4 rounded-24 border-0 shadow-premium mb-4" role="alert" style="background-color: #d1fae5; border: 1px solid #a7f3d0 !important;">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; flex-shrink: 0; background-color: #10b981 !important;">
                                <i class="fe fe-check fs-4"></i>
                            </div>
                            <div class="text-start">
                                <h4 class="fw-bold text-emerald-900 mb-0" style="color: #065f46;">Thank You!</h4>
                                <p class="text-emerald-800 small mb-0" style="color: #047857;">{{ session('t-success') }}</p>
                            </div>
                        </div>

                        @if(session('payment_success_details'))
                            @php $details = session('payment_success_details'); @endphp
                            <div class="bg-white bg-opacity-75 p-3 rounded-16 border border-success border-opacity-20 mt-3 text-start">
                                <div class="row g-2 small">
                                    <div class="col-6 text-muted">Payment Method:</div>
                                    <div class="col-6 fw-bold text-slate-900">{{ $details['method'] }}</div>
                                    <div class="col-6 text-muted">Paid To:</div>
                                    <div class="col-6 fw-bold text-slate-900">{{ $details['number'] }}</div>
                                    @if(!empty($details['trx_id']))
                                        <div class="col-6 text-muted">Transaction ID:</div>
                                        <div class="col-6 fw-bold text-slate-900">{{ $details['trx_id'] }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if(session('t-error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-16 p-3" role="alert" style="background-color: #fee2e2; color: #991b1b; border-color: #fecaca;">
                        <strong>Error!</strong> {{ session('t-error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-16 p-3" role="alert" style="background-color: #fee2e2; color: #991b1b; border-color: #fecaca;">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <form action="{{ route('product.order') }}" method="POST" id="order-form">
                    @csrf
                    <input type="hidden" name="module_type" value="{{ $module_type ?? '' }}">
                    <div class="row g-3">
                        <div class="col-12 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-shopping-bag me-1 text-primary"></i> Select Item</label>
                            <select name="product_id" class="form-select custom-input text-slate-800" required>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-user me-1 text-primary"></i> Your Name</label>
                            <input type="text" name="name" class="form-control custom-input" placeholder="Full Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-12 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-mail me-1 text-primary"></i> Email Address</label>
                            <input type="email" name="email" class="form-control custom-input" placeholder="email@example.com" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-12 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-phone me-1 text-primary"></i>  Payment Number</label>
                            <input type="text" name="phone" class="form-control custom-input" placeholder="01XXXXXXXXX" value="{{ old('phone') }}" required>
                        </div>
                        <!-- <div class="col-md-6 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-map-pin me-1 text-primary"></i> Shipping Address</label>
                            <input type="text" name="address" class="form-control custom-input" placeholder="Your Address" value="{{ old('address') }}" required>
                        </div> -->

                        <!-- Integrated Payment Fields -->
                        @php
                            $systemSetting = App\Models\Setting::first();
                            $bkashNumber = $systemSetting->bkash_number ?? null;
                            $nagadNumber = $systemSetting->nagad_number ?? null;
                        @endphp
                        @if($bkashNumber || $nagadNumber)
                            <div class="col-12 mt-4 text-start">
                                <label class="form-label text-slate-700 fw-semibold small d-block mb-2"><i class="fe fe-credit-card me-1 text-primary"></i> Select Payment Method & Pay</label>
                                <div class="d-flex gap-3 mb-3">
                                    @if($bkashNumber)
                                        <div class="payment-method-card flex-fill text-center p-3 rounded-20 border cursor-pointer d-flex flex-column align-items-center justify-content-center" id="method-bkash" onclick="selectPayment('bkash', '{{ $bkashNumber }}')">
                                            <img src="{{ asset('default/bkash.svg') }}" alt="bKash" class="payment-logo mb-2 animate__animated animate__fadeIn" style="height: 32px; object-fit: contain;">
                                            <div class="small fw-bold text-slate-800">bKash</div>
                                        </div>
                                    @endif
                                    @if($nagadNumber)
                                        <div class="payment-method-card flex-fill text-center p-3 rounded-20 border cursor-pointer d-flex flex-column align-items-center justify-content-center" id="method-nagad" onclick="selectPayment('nagad', '{{ $nagadNumber }}')">
                                            <img src="{{ asset('default/nagad.svg') }}" alt="Nagad" class="payment-logo mb-2 animate__animated animate__fadeIn" style="height: 38px; object-fit: contain; margin-top: -3px;">
                                            <div class="small fw-bold text-slate-800">Nagad</div>
                                        </div>
                                    @endif
                                </div>

                                <input type="hidden" name="payment_method" id="selected_payment_method" value="">

                                <!-- Payment Instructions -->
                                <div id="payment-instruction-box" class="bg-light p-3 rounded-20 border mb-3 d-none animate__animated animate__fadeIn">
                                    <p class="small text-slate-700 mb-2">Please Send Money to this Personal Number:</p>
                                    <div class="d-flex align-items-center justify-content-between bg-white p-2 px-3 rounded-16 border">
                                        <span id="payment-number" class="fw-bold text-slate-900 fs-5"></span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fs-12" id="copy-btn" onclick="copyNumber()">Copy</button>
                                    </div>
                                    <div class="text-success mt-2 small d-none" id="copy-success">
                                        <i class="fe fe-check-circle me-1"></i> Number copied to clipboard!
                                    </div>
                                </div>

                                <!-- Transaction ID Field -->
                                <div id="transaction-id-group" class="form-group d-none animate__animated animate__fadeIn">
                                    <label for="transaction_id" class="form-label text-slate-700 fw-semibold small">Transaction ID (TrxID)</label>
                                    <input type="text" name="transaction_id" id="transaction_id" class="form-control custom-input" placeholder="e.g. 8N70XDPQ9S" value="{{ old('transaction_id') }}">
                                </div>
                            </div>
                        @endif

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-gradient-primary w-100 rounded-pill py-3 fw-bold text-white shadow-premium hover-scale" id="submit-btn">
                                Submit Order / Inquiry <i class="fe fe-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('script')
<script>
    function selectPayment(method, number) {
        // Reset active state
        document.querySelectorAll('.payment-method-card').forEach(function(card) {
            card.classList.remove('active');
        });

        // Set active state for selected
        document.getElementById('method-' + method).classList.add('active');

        // Set hidden input value
        document.getElementById('selected_payment_method').value = method;

        // Show payment instruction box
        document.getElementById('payment-number').innerText = number;
        document.getElementById('payment-instruction-box').classList.remove('d-none');

        // Show transaction input group and make input required
        document.getElementById('transaction-id-group').classList.remove('d-none');
        document.getElementById('transaction_id').setAttribute('required', 'required');
        
        // Reset copy success label
        document.getElementById('copy-success').classList.add('d-none');
    }

    function copyNumber() {
        var num = document.getElementById('payment-number').innerText;
        navigator.clipboard.writeText(num).then(function() {
            var copySuccess = document.getElementById('copy-success');
            copySuccess.classList.remove('d-none');
            setTimeout(function() {
                copySuccess.classList.add('d-none');
            }, 3000);
        });
    }

    // Handle Loading State during Submission
    document.getElementById('order-form').addEventListener('submit', function() {
        var btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing Submission...`;
    });
</script>
@endpush

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
        background-color: #f8fafc;
    }

    /* Modern Utilities */
    .fw-black { font-weight: 800; }
    .text-slate-700 { color: var(--slate-700) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-850 { color: #1e293b !important; }
    .text-slate-900 { color: var(--slate-900) !important; }
    
    .max-w-450 { max-width: 450px; }
    .max-w-500 { max-width: 500px; }
    .max-w-550 { max-width: 550px; }
    .max-w-600 { max-width: 600px; }
    .max-w-650 { max-width: 650px; }
    
    .rounded-20 { border-radius: 20px !important; }
    .rounded-24 { border-radius: 24px !important; }
    .rounded-32 { border-radius: 32px !important; }
    .rounded-16 { border-radius: 16px !important; }
    .tracking-wider { letter-spacing: 0.05em; }
    .fs-11 { font-size: 11px; }
    .fs-12 { font-size: 12px; }
    .fs-15 { font-size: 15px; }
    .fs-16 { font-size: 16px; }
    .small-90 { font-size: 0.82rem; }
    .h-40px { height: auto; min-height: 40px; }

    /* Centered Hero Styles */
    .bg-premium-modern {
        background: linear-gradient(135deg, #eef2ff 0%, #faf5ff 100%);
    }
    .hero-grid-overlay {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(79, 70, 229, 0.05) 1.5px, transparent 1.5px);
        background-size: 24px 24px;
        z-index: 1;
        pointer-events: none;
    }
    .decor-blur-1 {
        position: absolute;
        top: -10%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: rgba(99, 102, 241, 0.1);
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
        background: rgba(124, 58, 237, 0.08);
        filter: blur(120px);
        border-radius: 50%;
        pointer-events: none;
    }

    .decor-glow-4 {
        position: absolute;
        top: -10%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
        filter: blur(80px);
        z-index: 1;
        pointer-events: none;
    }
    .decor-glow-5 {
        position: absolute;
        bottom: -10%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(124, 58, 237, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
        filter: blur(80px);
        z-index: 1;
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

    /* Glassmorphic Form Card */
    .bg-premium-form-modern {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    }
    .modern-glass-card {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.7) !important;
        box-shadow: 0 30px 60px rgba(15, 23, 42, 0.08) !important;
    }
    .custom-input {
        background-color: rgba(248, 250, 252, 0.8) !important;
        border: 1px solid #cbd5e1 !important;
        padding: 0.8rem 1.1rem !important;
        border-radius: 16px !important;
        font-size: 0.95rem;
        transition: all 0.25s ease;
    }
    .custom-input:focus {
        background-color: #ffffff !important;
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15) !important;
        color: var(--slate-900);
    }

    /* Aspect-ratio Fit Card Images with Blurs */
    .card-img-wrapper {
        position: relative;
        height: 220px;
        background-color: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .card-bg-blur {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        filter: blur(15px);
        opacity: 0.65;
        transform: scale(1.1);
        z-index: 1;
    }
    .card-img-top-custom {
        position: relative;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        z-index: 2;
        transition: transform 0.5s ease;
    }
    .modern-product-card:hover .card-img-top-custom {
        transform: scale(1.04);
    }

    .modern-product-card {
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.02);
        border: 1px solid #f1f5f9 !important;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
    }
    .modern-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px rgba(15, 23, 42, 0.07);
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
        z-index: 2;
    }

    /* Payment Method Selection Card */
    .payment-method-card {
        transition: all 0.25s ease;
        background-color: rgba(248, 250, 252, 0.8);
        border: 2px solid #e2e8f0 !important;
        cursor: pointer;
    }
    .payment-method-card:hover {
        border-color: #cbd5e1 !important;
        transform: translateY(-2px);
    }
    .payment-method-card.active {
        border-color: #4f46e5 !important;
        background-color: rgba(99, 102, 241, 0.05) !important;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.12) !important;
    }

    /* Custom Buttons */
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
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
    }
    .hover-scale:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(99, 102, 241, 0.25) !important;
    }

    /* Layout Alignments */
    .line-clamp-2 {
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .section-title::after {
        content: ''; position: absolute; bottom: -6px; left: 50%; transform: translateX(-50%);
        width: 45px; height: 4px; background: var(--primary-gradient); border-radius: 2px;
    }
    .shadow-premium {
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04) !important;
    }

    /* Fluid Responsiveness Queries */
    @media (max-width: 991.98px) {
        .py-6 { padding-top: 4.5rem; padding-bottom: 4.5rem; }
        .py-lg-8 { padding-top: 5rem; padding-bottom: 5rem; }
        .display-3 { font-size: 2.75rem !important; }
    }
    @media (max-width: 576px) {
        .display-3 { font-size: 1.95rem !important; }
        .card-img-wrapper { height: 180px; }
        .card.p-sm-5 { padding: 1.5rem !important; }
        .rounded-32 { border-radius: 24px !important; }
        .modern-glass-card { padding: 1.5rem !important; }
        .payment-method-card {
            padding: 1rem !important;
            border-radius: 16px !important;
        }
        .payment-logo {
            height: 28px !important;
        }
    }
</style>
@endsection