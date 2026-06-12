@extends('frontend.simple.app', ['title' => $course->title])

@section('content')
<!-- Course Header / Hero Section -->
<section class="py-5 py-lg-7 bg-premium-dark position-relative overflow-hidden text-white">
    <!-- Sophisticated Ambient Light Blurs -->
    <div class="dark-decor-blur-1"></div>
    <div class="dark-decor-blur-2"></div>
    
    <div class="container position-relative z-index-2 py-3 py-lg-4">
        <div class="row align-items-center g-4 g-lg-5">
            <!-- Left Content -->
            <div class="col-lg-7 text-center text-lg-start">
                <span class="badge bg-primary-soft text-primary-light fw-semibold px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fs-12 border border-primary-800 animate__animated animate__fadeInDown">
                    <i class="fe fe-award me-1"></i> Specialization Track
                </span>
                <h1 class="display-4 fw-black mb-3 lh-sm text-white animate__animated animate__fadeInUp">
                    {{ $course->title }}
                </h1>
                <p class="lead text-slate-300 mb-4 px-2 px-lg-0 mx-auto mx-lg-0 max-w-600 fw-medium animate__animated animate__fadeInUp animate__delay-1s">
                    {{ Str::limit(strip_tags($course->description), 180) }}
                </p>
                
                <!-- Quick Features Info -->
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3 gap-sm-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="d-flex align-items-center bg-white-05 px-3 py-2 rounded-12 border border-white-05">
                        <div class="feature-icon-sm bg-primary-soft text-primary-light me-2">
                            <i class="fe fe-users"></i>
                        </div>
                        <span class="fw-semibold text-white fs-14">Interactive Curriculum</span>
                    </div>
                    <div class="d-flex align-items-center bg-white-05 px-3 py-2 rounded-12 border border-white-05">
                        <div class="feature-icon-sm bg-success-soft text-success me-2">
                            <i class="fe fe-clock"></i>
                        </div>
                        <span class="fw-semibold text-white fs-14">Self-paced Learning</span>
                    </div>
                    <div class="d-flex align-items-center bg-white-05 px-3 py-2 rounded-12 border border-white-05">
                        <div class="feature-icon-sm bg-warning-soft text-warning me-2">
                            <i class="fe fe-award"></i>
                        </div>
                        <span class="fw-semibold text-white fs-14">Verified Certificate</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Media Card -->
            <div class="col-lg-5 animate__animated animate__fadeInRight">
                <div class="card border-0 bg-slate-900-80 glass-card-dark rounded-32 overflow-hidden shadow-xl max-w-450 mx-auto">
                    <div class="position-relative card-img-wrapper-detail">
                        <!-- Background Blurring for Image Consistency -->
                        <div class="card-bg-blur" style="background-image: url('{{ asset($course->image ?? 'default/course.jpg') }}');"></div>
                        <img src="{{ asset($course->image ?? 'default/course.jpg') }}" class="card-img-top-custom-detail" alt="{{ $course->title }}">
                        <div class="img-gradient-overlay"></div>
                    </div>
                    <div class="card-body p-4 text-center">
                        @if($course->price)
                            <div class="mb-3">
                                <span class="text-slate-400 small fw-medium d-block mb-1">Course Investment</span>
                                <h2 class="fw-black text-gradient-primary mb-0 fs-36">৳{{ number_format($course->price) }}</h2>
                            </div>
                        @endif
                        <a href="#enroll-form" class="btn btn-gradient-primary w-100 rounded-pill py-3 fw-bold text-white shadow-md hover-scale">
                            <i class="fe fe-shopping-bag me-2"></i> Enroll in Course
                        </a>
                        <p class="small text-slate-400 mt-3 mb-0 d-flex align-items-center justify-content-center">
                            <i class="fe fe-shield text-success me-2 fs-16"></i> Secured Payment Gateway
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Content Section -->
<section class="py-5 py-lg-6 bg-premium-light-gray">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <!-- Left Layout: Overview & Curriculum -->
            <div class="col-lg-8">
                <!-- What you will learn -->
                <div class="card border-0 bg-white shadow-premium rounded-24 p-4 p-sm-5 mb-4 border border-slate-100">
                    <h3 class="fw-bold text-slate-900 mb-4 position-relative d-inline-block pb-2">
                        What You Will Master
                        <span class="title-bar"></span>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <span class="bg-success-soft text-success rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; flex-shrink: 0;"><i class="fe fe-check fs-12"></i></span>
                                <span class="text-slate-700 small fw-medium">Industry-standard core methodologies</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <span class="bg-success-soft text-success rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; flex-shrink: 0;"><i class="fe fe-check fs-12"></i></span>
                                <span class="text-slate-700 small fw-medium">Practical hands-on case studies</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <span class="bg-success-soft text-success rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; flex-shrink: 0;"><i class="fe fe-check fs-12"></i></span>
                                <span class="text-slate-700 small fw-medium">Direct support mentoring</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <span class="bg-success-soft text-success rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; flex-shrink: 0;"><i class="fe fe-check fs-12"></i></span>
                                <span class="text-slate-700 small fw-medium">Lifetime curriculum access & updates</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Overview -->
                <div class="card border-0 bg-white shadow-premium rounded-24 p-4 p-sm-5 mb-4 border border-slate-100">
                    <h3 class="fw-bold text-slate-900 mb-3 position-relative d-inline-block pb-2">
                        Course Overview
                        <span class="title-bar"></span>
                    </h3>
                    <div class="text-slate-700 dynamic-content lh-relaxed">
                        {!! $course->description !!}
                    </div>
                </div>

                <!-- Course Curriculum -->
                <div class="card border-0 bg-white shadow-premium rounded-24 p-4 p-sm-5 mb-4 border border-slate-100">
                    <h3 class="fw-bold text-slate-900 mb-2 position-relative d-inline-block pb-2">
                        Course Curriculum
                        <span class="title-bar"></span>
                    </h3>
                    <p class="text-muted small mb-4">Structured modules designed to take you from beginner to advanced level.</p>
                    
                    <div class="accordion accordion-custom" id="curriculumAccordion">
                        @forelse($course->curricula as $key => $module)
                        <div class="accordion-item border border-slate-100 mb-3 rounded-16 overflow-hidden shadow-sm bg-white">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }} fw-bold py-3 text-slate-800" type="button" data-bs-toggle="collapse" data-bs-target="#module{{ $key }}">
                                    <div class="accordion-icon-box me-3">
                                        <i class="fe fe-book-open"></i>
                                    </div> 
                                    <span class="fs-15">{{ $module->title }}</span>
                                </button>
                            </h2>
                            <div id="module{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" data-bs-parent="#curriculumAccordion">
                                <div class="accordion-body bg-slate-50 text-slate-600 border-top border-slate-100 py-3 px-4 fs-14 text-start">
                                    {!! $module->description !!}
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-muted bg-slate-50 rounded-16 border border-dashed">
                            <i class="fe fe-folder-minus fs-24 d-block mb-2 text-slate-400"></i>
                            <p class="mb-0 small">Curriculum details coming soon. Stay tuned!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Layout: Sticky Enrollment Form -->
            <div class="col-lg-4">
                <div id="enroll-form" class="card border-0 bg-white shadow-xl rounded-24 p-4 sticky-lg-top border border-slate-100" style="top: 30px; z-index: 10;">
                    <div class="text-center mb-4">
                        <div class="form-badge bg-primary-soft text-primary rounded-pill d-inline-block px-3 py-1 small fw-bold mb-2">Enrollment Panel</div>
                        <h4 class="fw-bold text-slate-900 mb-1">Instant Enrollment</h4>
                        <p class="text-muted small mb-0">Fill in details and complete payment to enroll.</p>
                    </div>

                    @if(session('t-success'))
                        <div class="alert alert-success p-3 rounded-20 border-0 shadow-premium mb-4" role="alert" style="background-color: #d1fae5; border: 1px solid #a7f3d0 !important;">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2.5" style="width: 38px; height: 38px; flex-shrink: 0; background-color: #10b981 !important;">
                                    <i class="fe fe-check fs-5"></i>
                                </div>
                                <div class="text-start">
                                    <h5 class="fw-bold text-emerald-900 mb-0" style="color: #065f46; font-size: 14px;">Thank You!</h5>
                                    <p class="text-emerald-800 small mb-0" style="color: #047857; font-size: 12px;">{{ session('t-success') }}</p>
                                </div>
                            </div>

                            @if(session('payment_success_details'))
                                @php $details = session('payment_success_details'); @endphp
                                <div class="bg-white bg-opacity-75 p-2 px-3 rounded-12 border border-success border-opacity-20 mt-2 text-start">
                                    <div class="row g-1 small fs-11">
                                        <div class="col-6 text-muted">Method:</div>
                                        <div class="col-6 fw-bold text-slate-900">{{ $details['method'] }}</div>
                                        <div class="col-6 text-muted">Paid To:</div>
                                        <div class="col-6 fw-bold text-slate-900">{{ $details['number'] }}</div>
                                        @if(!empty($details['trx_id']))
                                            <div class="col-6 text-muted">TrxID:</div>
                                            <div class="col-6 fw-bold text-slate-900">{{ $details['trx_id'] }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if(session('t-error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-16 p-3 fs-13" role="alert" style="background-color: #fee2e2; color: #991b1b; border-color: #fecaca;">
                            {{ session('t-error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-16 p-3 fs-13" role="alert" style="background-color: #fee2e2; color: #991b1b; border-color: #fecaca;">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('course.enroll') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        
                        <div class="mb-3 text-start">
                            <label class="form-label small text-slate-700 fw-semibold"><i class="fe fe-user me-1 text-primary"></i> Full Name</label>
                            <input type="text" name="name" class="form-control rounded-pill custom-input-field px-4" placeholder="Your Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small text-slate-700 fw-semibold"><i class="fe fe-mail me-1 text-primary"></i> Email Address</label>
                            <input type="email" name="email" class="form-control rounded-pill custom-input-field px-4" placeholder="email@example.com" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small text-slate-700 fw-semibold"><i class="fe fe-phone me-1 text-primary"></i> Phone Number</label>
                            <input type="text" name="phone" class="form-control rounded-pill custom-input-field px-4" placeholder="01XXXXXXXXX" value="{{ old('phone') }}" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small text-slate-700 fw-semibold"><i class="fe fe-map-pin me-1 text-primary"></i> Current Address</label>
                            <textarea name="address" class="form-control rounded-20 custom-input-field px-4 py-3" rows="2" placeholder="Full Address" required>{{ old('address') }}</textarea>
                        </div>

                        <!-- Integrated Payment Fields -->
                        @php
                            $systemSetting = App\Models\Setting::first();
                            $bkashNumber = $systemSetting->bkash_number ?? null;
                            $nagadNumber = $systemSetting->nagad_number ?? null;
                        @endphp
                        @if($bkashNumber || $nagadNumber)
                            <div class="mb-3 text-start">
                                <label class="form-label small text-slate-700 fw-semibold d-block mb-2"><i class="fe fe-credit-card me-1 text-primary"></i> Select Payment Method & Pay</label>
                                <div class="d-flex gap-2 mb-3">
                                    @if($bkashNumber)
                                        <div class="payment-method-card flex-fill text-center p-2 rounded-16 border cursor-pointer d-flex flex-column align-items-center justify-content-center" id="method-bkash" onclick="selectPayment('bkash', '{{ $bkashNumber }}')">
                                            <img src="{{ asset('default/bkash.svg') }}" alt="bKash" class="payment-logo mb-1 animate__animated animate__fadeIn" style="height: 26px; object-fit: contain;">
                                            <div style="font-size: 11px;" class="fw-bold text-slate-800">bKash</div>
                                        </div>
                                    @endif
                                    @if($nagadNumber)
                                        <div class="payment-method-card flex-fill text-center p-2 rounded-16 border cursor-pointer d-flex flex-column align-items-center justify-content-center" id="method-nagad" onclick="selectPayment('nagad', '{{ $nagadNumber }}')">
                                            <img src="{{ asset('default/nagad.svg') }}" alt="Nagad" class="payment-logo mb-1 animate__animated animate__fadeIn" style="height: 30px; object-fit: contain; margin-top: -3px;">
                                            <div style="font-size: 11px;" class="fw-bold text-slate-800">Nagad</div>
                                        </div>
                                    @endif
                                </div>

                                <input type="hidden" name="payment_method" id="selected_payment_method" value="">

                                <!-- Payment Instructions -->
                                <div id="payment-instruction-box" class="bg-light p-3 rounded-20 border mb-3 d-none animate__animated animate__fadeIn">
                                    <p class="small text-slate-700 mb-2 fs-12">Please Send Money to this Personal Number:</p>
                                    <div class="d-flex align-items-center justify-content-between bg-white p-2 px-3 rounded-16 border">
                                        <span id="payment-number" class="fw-bold text-slate-900 fs-15"></span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fs-11" id="copy-btn" onclick="copyNumber()">Copy</button>
                                    </div>
                                    <div class="text-success mt-2 fs-11 d-none" id="copy-success">
                                        <i class="fe fe-check-circle me-1"></i> copied!
                                    </div>
                                </div>

                                <!-- Transaction ID Field -->
                                <div id="transaction-id-group" class="form-group d-none animate__animated animate__fadeIn">
                                    <label for="transaction_id" class="form-label text-slate-700 fw-semibold small">Transaction ID (TrxID)</label>
                                    <input type="text" name="transaction_id" id="transaction_id" class="form-control rounded-pill custom-input-field px-4" placeholder="e.g. 8N70XDPQ9S" value="{{ old('transaction_id') }}">
                                </div>
                            </div>
                        @endif
                        
                        <button type="submit" class="btn btn-gradient-primary btn-lg w-100 rounded-pill py-3 mt-2 fw-bold text-white shadow-md hover-scale fs-15">
                            Complete Enrollment <i class="fe fe-arrow-right ms-1"></i>
                        </button>
                    </form>
                    
                    <div class="mt-4 text-center p-3 bg-slate-50 rounded-16 border border-slate-100">
                        <p class="small text-muted mb-0"><i class="fe fe-info text-primary me-2"></i>You will receive an enrollment verification alert shortly after submission.</p>
                    </div>
                </div>
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

<!-- Advanced Professional Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-color: #4f46e5;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #475569;
        --slate-300: #cbd5e1;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* Helper Utilities */
    .fw-black { font-weight: 800; }
    .text-slate-300 { color: var(--slate-300) !important; }
    .text-slate-700 { color: var(--slate-700) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .text-primary-light { color: #a5b4fc !important; }
    .max-w-450 { max-width: 450px; }
    .max-w-600 { max-width: 600px; }
    .rounded-32 { border-radius: 32px !important; }
    .rounded-24 { border-radius: 24px !important; }
    .rounded-20 { border-radius: 20px !important; }
    .rounded-16 { border-radius: 16px !important; }
    .rounded-12 { border-radius: 12px !important; }
    .tracking-wider { letter-spacing: 0.05em; }
    .fs-11 { font-size: 11px; }
    .fs-12 { font-size: 12px; }
    .fs-14 { font-size: 14px; }
    .fs-15 { font-size: 15px; }
    .fs-16 { font-size: 16px; }
    .fs-36 { font-size: 36px; }
    .bg-slate-50 { background-color: #f8fafc !important; }
    
    /* Premium Dark Header Gradient */
    .bg-premium-dark {
        background: linear-gradient(135deg, #090d16 0%, #0f172a 100%) !important;
    }
    .bg-premium-light-gray {
        background: #f8fafc;
    }

    /* Ambient Glowing Light Elements (Gorgeous Theme) */
    .dark-decor-blur-1 {
        position: absolute;
        top: -20%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: rgba(99, 102, 241, 0.07);
        filter: blur(130px);
        border-radius: 50%;
        pointer-events: none;
    }
    .dark-decor-blur-2 {
        position: absolute;
        bottom: -20%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(124, 58, 237, 0.06);
        filter: blur(130px);
        border-radius: 50%;
        pointer-events: none;
    }

    /* Primary Gradients & Badges */
    .text-gradient-primary {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .btn-gradient-primary {
        background: var(--primary-gradient);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
        color: white;
    }
    .bg-primary-soft { background-color: rgba(99, 102, 241, 0.12) !important; }
    .bg-success-soft { background-color: rgba(34, 197, 94, 0.12) !important; }
    .bg-warning-soft { background-color: rgba(245, 158, 11, 0.12) !important; }
    .border-primary-800 { border-color: rgba(99, 102, 241, 0.3) !important; }
    .bg-white-05 { background-color: rgba(255, 255, 255, 0.05); }
    .border-white-05 { border-color: rgba(255, 255, 255, 0.08) !important; }

    .feature-icon-sm {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 14px;
    }

    /* Detail Hero Right Card Overlay */
    .glass-card-dark {
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25) !important;
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
    }
    .card-img-wrapper-detail {
        position: relative;
        height: 280px;
        background-color: #090d16;
        display: flex;
        align-items: center;
        justify-content: center;
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
    .card-img-top-custom-detail {
        position: relative;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        z-index: 2;
    }
    .img-gradient-overlay {
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 40%;
        background: linear-gradient(180deg, rgba(15,23,42,0) 0%, rgba(15,23,42,0.6) 100%);
    }

    /* Content Styling & Titles */
    .shadow-premium {
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.03) !important;
    }
    .shadow-xl {
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.07) !important;
    }
    .title-bar {
        position: absolute;
        bottom: 0; left: 0; width: 40px; height: 3px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }
    .dynamic-content p {
        margin-bottom: 1rem;
        font-size: 0.98rem;
    }

    /* Custom Modern Accordion */
    .accordion-custom .accordion-item {
        border-color: #f1f5f9 !important;
    }
    .accordion-custom .accordion-button {
        background-color: #ffffff;
        box-shadow: none !important;
        padding: 1.1rem 1.25rem;
    }
    .accordion-custom .accordion-button:not(.collapsed) {
        background-color: rgba(99, 102, 241, 0.02);
        color: var(--primary-color) !important;
    }
    .accordion-icon-box {
        width: 32px; height: 32px;
        background-color: #f1f5f9;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #64748b;
        transition: all 0.2s ease;
    }
    .accordion-custom .accordion-button:not(.collapsed) .accordion-icon-box {
        background-color: var(--primary-color);
        color: #ffffff;
    }

    /* Inputs Tweak */
    .custom-input-field {
        background-color: #f8fafc !important;
        border: 1px solid #cbd5e1 !important;
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    .custom-input-field:focus {
        background-color: #ffffff !important;
        border-color: #a5b4fc !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08) !important;
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
        transform: translateY(-1px);
    }
    .payment-method-card.active {
        border-color: #4f46e5 !important;
        background-color: rgba(99, 102, 241, 0.05) !important;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.12) !important;
    }

    /* Interactions */
    .hover-scale {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-scale:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.15) !important;
    }

    /* Desktop Sticky Alignment */
    @media (min-width: 992px) {
        .sticky-lg-top {
            position: sticky !important;
            top: 40px !important;
        }
    }

    /* Responsive Mobile Media Queries */
    @media (max-width: 991.98px) {
        .py-lg-6 { padding-top: 3.5rem; padding-bottom: 3.5rem; }
        .display-4 { font-size: 2.2rem !important; }
        .sticky-lg-top { position: static !important; }
    }
    
    @media (max-width: 576px) {
        .display-4 { font-size: 1.8rem !important; }
        .card-img-wrapper-detail { height: 190px; }
        .card.p-sm-5 { padding: 1.25rem !important; }
        .fs-36 { font-size: 28px; }
    }
</style>
@endsection