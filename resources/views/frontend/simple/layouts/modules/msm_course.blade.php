@extends('frontend.simple.app', ['title' => 'MSM Course'])

@section('content')
<!-- Premium Hero Section -->
<section class="py-6 py-lg-8 position-relative overflow-hidden bg-hero-gradient">
    <!-- Grid Overlay and Glow Effects -->
    <div class="hero-grid-overlay"></div>
    <div class="decor-glow-1"></div>
    <div class="decor-glow-2"></div>
    
    <div class="container position-relative z-index-2">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10 col-xl-8">
                <span class="badge bg-primary-soft text-primary fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fs-11 border border-primary-100 animate__animated animate__fadeInDown">
                    <i class="fe fe-award me-1"></i> Global Professional Standards
                </span>
                
                <h1 class="display-3 fw-black text-slate-900 mb-4 lh-sm animate__animated animate__fadeInUp">
                    Elevate Your Career with <br class="d-none d-md-block">
                    <span class="text-gradient position-relative">
                        MSM Professional Course
                        <span class="header-underline"></span>
                    </span>
                </h1>
                
                <p class="lead text-slate-700 mb-5 max-w-650 mx-auto fw-medium animate__animated animate__fadeInUp animate__delay-1s">
                    Accelerate your learning curve with our masterclass curricula. Crafted by domain experts to prepare you for the next-generation global workforce.
                </p>
                
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center align-items-center mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                    <a href="#enrollment-form-section" class="btn btn-gradient-primary rounded-pill px-5 py-3 fw-bold text-white shadow-premium hover-scale">
                        Start Learning Today <i class="fe fe-arrow-right ms-2"></i>
                    </a>
                    <a href="#courses-section" class="btn btn-outline-custom rounded-pill px-5 py-3 fw-bold bg-white shadow-sm hover-scale">
                        View Modules
                    </a>
                </div>
                
                <!-- Trust & Stats Badge -->
                <div class="row g-3 justify-content-center max-w-600 mx-auto mt-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="col-6 col-sm-4">
                        <div class="d-flex align-items-center justify-content-center bg-white bg-opacity-80 backdrop-blur p-3 rounded-24 shadow-premium border border-white">
                            <div class="stat-icon bg-primary-soft text-primary me-2">
                                <i class="fe fe-users fs-5"></i>
                            </div>
                            <div class="text-start">
                                <h5 class="fw-bold text-slate-900 mb-0">8,500+</h5>
                                <small class="text-muted fw-semibold fs-11">Enrolled</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="d-flex align-items-center justify-content-center bg-white bg-opacity-80 backdrop-blur p-3 rounded-24 shadow-premium border border-white">
                            <div class="stat-icon bg-warning-soft text-warning me-2">
                                <i class="fe fe-star fs-5"></i>
                            </div>
                            <div class="text-start">
                                <h5 class="fw-bold text-slate-900 mb-0">4.9/5</h5>
                                <small class="text-muted fw-semibold fs-11">Rating (1.2k)</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 d-none d-sm-block">
                        <div class="d-flex align-items-center justify-content-center bg-white bg-opacity-80 backdrop-blur p-3 rounded-24 shadow-premium border border-white">
                            <div class="stat-icon bg-success-soft text-success me-2">
                                <i class="fe fe-check-circle fs-5"></i>
                            </div>
                            <div class="text-start">
                                <h5 class="fw-bold text-slate-900 mb-0">100%</h5>
                                <small class="text-muted fw-semibold fs-11">Satisfaction</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Modules Section -->
<section id="courses-section" class="py-6 bg-light-section position-relative">
    <div class="decor-glow-3"></div>
    <div class="container position-relative z-index-1">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h2 class="fw-bold text-slate-900 mb-2 section-title position-relative d-inline-block">Specialized Modules</h2>
            <p class="text-muted small">Choose the course track that matches your professional aspiration.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($courses as $course)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 premium-card bg-white rounded-28 overflow-hidden shadow-premium">
                    <div class="position-relative overflow-hidden card-img-wrapper">
                        <!-- Dual blurred background + object-fit contain foreground to display images beautifully regardless of aspect ratio -->
                        <div class="card-bg-blur" style="background-image: url('{{ asset($course->image ?? 'default/course.jpg') }}');"></div>
                        <img src="{{ asset($course->image ?? 'default/course.jpg') }}" class="card-img-top-custom" alt="{{ $course->title }}">
                        <div class="card-img-gradient"></div>
                        @if($course->price)
                            <span class="badge price-tag-gradient text-white fw-bold shadow-md">
                                ৳{{ number_format($course->price) }}
                            </span>
                        @endif
                        <span class="badge bg-primary position-absolute top-3 start-3 rounded-pill px-3 py-2 fs-10 fw-bold tracking-wider text-uppercase z-index-2">
                            New Track
                        </span>
                    </div>
                    <div class="card-body p-4 d-flex flex-column position-relative">
                        <!-- Rating and Level Badge -->
                        <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                            <span class="badge bg-primary-soft text-primary fs-11 rounded-pill px-2.5 py-1 fw-bold"><i class="fe fe-book-open me-1"></i> Interactive</span>
                            <span class="badge bg-warning-soft text-warning fs-11 rounded-pill px-2.5 py-1 fw-bold"><i class="fe fe-star me-1"></i> 4.9 (1.2k)</span>
                        </div>

                        <h5 class="fw-bold text-slate-900 mb-2 line-clamp-2 h-50px">{{ $course->title }}</h5>
                        <p class="text-slate-600 small mb-4 flex-grow-1 line-clamp-3">
                            {{ Str::limit(strip_tags($course->description), 95) }}
                        </p>
                        
                        <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-auto">
                            <span class="small text-muted"><i class="fe fe-clock me-1 text-primary"></i> Self-paced</span>
                            <a href="{{ route('course.details', $course->id) }}" class="btn btn-sm btn-outline-custom rounded-pill px-4 fw-bold">
                                Details <i class="fe fe-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if(isset($faqs) && $faqs->isNotEmpty())
<!-- FAQ Section -->
<section class="py-6 bg-white border-top position-relative">
    <div class="container">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h2 class="fw-bold text-slate-900 mb-2 section-title position-relative d-inline-block">Frequently Asked Questions</h2>
            <p class="text-muted small">Find quick answers to common queries organized by category.</p>
        </div>

        <div class="max-w-850 mx-auto">
            @foreach($faqs->groupBy('category') as $categoryName => $categoryFaqs)
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-4 border-bottom pb-2 text-start">
                        <span class="bg-primary-soft text-primary rounded-16 p-2 px-4 fs-6 fw-bold tracking-wide" style="color: var(--primary-color) !important;">
                            <i class="fe fe-folder-open me-2"></i> {{ $categoryName }}
                        </span>
                    </div>
                    <div class="accordion accordion-custom" id="faqAccordion-{{ \Illuminate\Support\Str::slug($categoryName) }}">
                        @foreach($categoryFaqs as $index => $faq)
                            <div class="accordion-item border-0 mb-3 rounded-24 shadow-premium overflow-hidden">
                                <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                    <button class="accordion-button collapsed fw-bold text-slate-800 px-4 py-3 bg-white" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapse-{{ $faq->id }}" 
                                            aria-expanded="false" 
                                            aria-controls="collapse-{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $faq->id }}" 
                                     class="accordion-collapse collapse" 
                                     aria-labelledby="heading-{{ $faq->id }}" 
                                     data-bs-parent="#faqAccordion-{{ \Illuminate\Support\Str::slug($categoryName) }}">
                                    <div class="accordion-body px-4 pb-4 pt-0 text-slate-600 small bg-white text-start">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Enrollment Form Section at the Bottom -->
<section id="enrollment-form-section" class="py-6 py-lg-8 bg-premium-form-modern position-relative overflow-hidden border-top">
    <div class="decor-glow-4"></div>
    <div class="decor-glow-5"></div>
    
    <div class="container position-relative z-index-2">
        <div class="max-w-650 mx-auto">
            <div class="card border-0 modern-glass-card rounded-32 p-4 p-md-5 shadow-premium">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-slate-900 mb-2">Secure Your Seat Today</h2>
                    <p class="text-slate-600 small">Fill up the form below to enroll or make an inquiry.</p>
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
                
                <form action="{{ route('course.enroll') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-layers me-1 text-primary"></i> Select Module</label>
                            <select name="course_id" class="form-select custom-input text-slate-800" required>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ (isset($featured_course) && $featured_course->id == $course->id) ? 'selected' : '' }}>{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-user me-1 text-primary"></i> Your Name</label>
                            <input type="text" name="name" class="form-control custom-input" placeholder="Full Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-12 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-map-pin me-1 text-primary"></i> Address</label>
                            <input type="text" name="address" class="form-control custom-input" placeholder="Your Address" value="{{ old('address') }}" required>
                        </div>
                        <div class="col-md-6 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-phone me-1 text-primary"></i> Phone</label>
                            <input type="text" name="phone" class="form-control custom-input" placeholder="01XXXXXXXXX" value="{{ old('phone') }}" required>
                        </div>
                        <div class="col-md-6 text-start">
                            <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-mail me-1 text-primary"></i> Email</label>
                            <input type="email" name="email" class="form-control custom-input" placeholder="email@example.com" value="{{ old('email') }}" required>
                        </div>

                        <!-- Payment Fields -->
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
                            <button type="submit" class="btn btn-gradient-primary w-100 rounded-pill py-3 fw-bold text-white shadow-premium hover-scale">
                                Submit Enrollment <i class="fe fe-arrow-right ms-2"></i>
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
</script>
@endpush

<!-- Premium Elegant Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-color: #4f46e5;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --light-bg: #f8fafc;
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #334155;
        --hero-gradient-start: #eef2ff;
        --hero-gradient-end: #faf5ff;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background-color: var(--light-bg);
    }

    /* Hero Section Styling */
    .bg-hero-gradient {
        background: linear-gradient(135deg, var(--hero-gradient-start) 0%, var(--hero-gradient-end) 100%);
    }
    
    .hero-grid-overlay {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(79, 70, 229, 0.05) 1.5px, transparent 1.5px);
        background-size: 24px 24px;
        z-index: 1;
        pointer-events: none;
    }

    /* Soft Glow Background Accents */
    .decor-glow-1 {
        position: absolute;
        top: -10%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, rgba(255, 255, 255, 0) 70%);
        filter: blur(80px);
        z-index: 1;
        pointer-events: none;
    }

    .decor-glow-2 {
        position: absolute;
        bottom: -20%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(124, 58, 237, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
        filter: blur(90px);
        z-index: 1;
        pointer-events: none;
    }

    .decor-glow-3 {
        position: absolute;
        top: 20%;
        right: 10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
        filter: blur(60px);
        z-index: 0;
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

    /* Header Underline Accent */
    .header-underline {
        position: absolute;
        bottom: 2px;
        left: 0;
        width: 100%;
        height: 8px;
        background: rgba(99, 102, 241, 0.2);
        border-radius: 4px;
        z-index: -1;
    }

    /* Typography Utilities */
    .fw-black { font-weight: 800; }
    .text-slate-900 { color: var(--slate-900); }
    .text-slate-800 { color: var(--slate-800); }
    .text-slate-700 { color: var(--slate-700); }
    
    .max-w-500 { max-width: 500px; }
    .max-w-600 { max-width: 600px; }
    .max-w-650 { max-width: 650px; }
    .max-w-800 { max-width: 800px; }
    .max-w-850 { max-width: 850px; }

    .rounded-20 { border-radius: 20px !important; }
    .rounded-24 { border-radius: 24px !important; }
    .rounded-28 { border-radius: 28px !important; }
    .rounded-32 { border-radius: 32px !important; }
    
    .tracking-wider { letter-spacing: 0.05em; }
    .fs-11 { font-size: 11px; }
    .fs-12 { font-size: 12px; }
    .h-50px { height: 50px; }

    /* Gradient Effects */
    .bg-light-section {
        background-color: #f8fafc;
    }
    
    .text-gradient {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .btn-gradient-primary {
        background: var(--primary-gradient);
        border: none;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
        color: white;
    }

    .bg-primary-soft { background-color: rgba(79, 70, 229, 0.08); }
    .bg-warning-soft { background-color: rgba(245, 158, 11, 0.1); }
    .bg-success-soft { background-color: rgba(16, 185, 129, 0.08); }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    /* Custom Buttons */
    .btn-outline-custom {
        color: var(--primary-color);
        border: 1.5px solid rgba(79, 70, 229, 0.2);
        padding: 10px 24px;
        transition: all 0.25s ease;
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

    /* Premium Course Cards */
    .premium-card {
        border: 1px solid rgba(15, 23, 42, 0.04) !important;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03) !important;
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.4s ease;
    }
    .premium-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 45px rgba(15, 23, 42, 0.08) !important;
    }
    .card-img-wrapper {
        position: relative;
        height: 220px;
        background-color: #0f172a; /* Slate 900 background to look premium */
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
        transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
    }
    .premium-card:hover .card-img-top-custom {
        transform: scale(1.04);
    }
    .card-img-gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.4) 0%, transparent 60%);
        z-index: 1;
    }
    .price-tag-gradient {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: var(--primary-gradient);
        padding: 8px 16px;
        border-radius: 14px;
        font-size: 0.95rem;
        z-index: 2;
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
        border: 1px solid #d1d5db !important;
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

    /* Accordion FAQ Styling */
    .accordion-custom .accordion-item {
        border: 1px solid rgba(15, 23, 42, 0.04) !important;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    .accordion-custom .accordion-item:hover {
        border-color: rgba(99, 102, 241, 0.15) !important;
        box-shadow: 0 15px 30px rgba(15, 23, 42, 0.05) !important;
    }
    .accordion-custom .accordion-button {
        box-shadow: none !important;
        font-size: 1.05rem;
        transition: all 0.25s ease;
    }
    .accordion-custom .accordion-button:not(.collapsed) {
        color: var(--primary-color) !important;
        background-color: #ffffff !important;
    }
    .accordion-custom .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%231e293b'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
        background-size: 1rem;
        transition: transform 0.25s ease-in-out;
    }
    .accordion-custom .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%234f46e5'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
    }

    /* Payment Method Cards */
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

    .shadow-premium {
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04) !important;
    }

    .border-primary-100 {
        border-color: rgba(99, 102, 241, 0.15) !important;
    }

    /* Line Clamp helpers */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }

    /* Title Underline */
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 50%;
        transform: translateX(-50%);
        width: 45px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    /* Fully Responsive Enhancements */
    @media (max-width: 991.98px) {
        .py-6 { padding-top: 4.5rem; padding-bottom: 4.5rem; }
        .py-lg-8 { padding-top: 5rem; padding-bottom: 5rem; }
        .display-3 { font-size: 2.75rem !important; }
    }
    
    @media (max-width: 767.98px) {
        .display-3 { font-size: 2.3rem !important; }
        .lead { font-size: 1.1rem !important; }
        .card-img-wrapper { height: 190px; }
    }
    
    @media (max-width: 575.98px) {
        .display-3 { font-size: 1.95rem !important; }
        .card-img-wrapper { height: 180px; }
        .rounded-32 { border-radius: 24px !important; }
        .modern-glass-card { padding: 1.5rem !important; }
        .premium-card { border-radius: 20px !important; }
        
        /* Interactive Mobile Experience Details */
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