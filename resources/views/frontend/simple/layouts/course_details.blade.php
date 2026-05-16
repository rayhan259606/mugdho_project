@extends('frontend.simple.app', ['title' => $course->title])

@section('content')
<!-- Course Header / Hero Section -->
<section class="py-5 py-lg-6 bg-premium-dark position-relative overflow-hidden text-white">
    <!-- Sophisticated Ambient Light Blurs -->
    <div class="dark-decor-blur-1"></div>
    <div class="dark-decor-blur-2"></div>
    
    <div class="container position-relative z-index-2 py-3 py-lg-4">
        <div class="row align-items-center g-4 g-lg-5">
            <!-- Left Content -->
            <div class="col-lg-7 text-center text-lg-start">
                <span class="badge bg-primary-soft text-primary-light fw-semibold px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fs-12 border border-primary-800 animate__animated animate__fadeInDown">
                    <i class="fe fe-star me-1"></i> New Course
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
                        <span class="fw-semibold text-white fs-14">{{ rand(100, 500) }}+ Students</span>
                    </div>
                    <div class="d-flex align-items-center bg-white-05 px-3 py-2 rounded-12 border border-white-05">
                        <div class="feature-icon-sm bg-success-soft text-success me-2">
                            <i class="fe fe-clock"></i>
                        </div>
                        <span class="fw-semibold text-white fs-14">12+ Hours Content</span>
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
                        <img src="{{ asset($course->image ?? 'default/course.jpg') }}" class="w-100 h-100 object-fit-cover" alt="{{ $course->title }}">
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
                            <i class="fe fe-shield text-success me-2 fs-16"></i> 30-Day Money Back Guarantee
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
                                <div class="accordion-body bg-slate-50 text-slate-600 border-top border-slate-100 py-3 px-4 fs-14">
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
                        <div class="form-badge bg-primary-soft text-primary rounded-pill d-inline-block px-3 py-1 small fw-bold mb-2">Secure Gateway</div>
                        <h4 class="fw-bold text-slate-900 mb-1">Enrollment Form</h4>
                        <p class="text-muted small mb-0">Fill in details to instantly access the course.</p>
                    </div>
                    
                    <form action="{{ route('course.enroll') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label small text-slate-700 fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control rounded-pill custom-input-field px-4" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-slate-700 fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-pill custom-input-field px-4" placeholder="email@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-slate-700 fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control rounded-pill custom-input-field px-4" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-slate-700 fw-semibold">Current Address</label>
                            <textarea name="address" class="form-control rounded-20 custom-input-field px-4 py-3" rows="2" placeholder="Full Address" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-gradient-primary btn-lg w-100 rounded-pill py-3 mt-2 fw-bold text-white shadow-md hover-scale">
                            Complete Enrollment <i class="fe fe-arrow-right ms-1"></i>
                        </button>
                    </form>
                    
                    <div class="mt-4 text-center p-3 bg-slate-50 rounded-16 border border-slate-100">
                        <p class="small text-muted mb-0"><i class="fe fe-info text-primary me-2"></i>You will receive a confirmation email shortly after submission.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
        height: 240px;
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
        border: 1px solid #e2e8f0 !important;
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