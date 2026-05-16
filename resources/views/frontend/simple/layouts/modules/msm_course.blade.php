@extends('frontend.simple.app', ['title' => 'MSM Course'])

@section('content')
<!-- Hero Section & Form -->
<section class="py-5 py-lg-7 bg-premium-modern position-relative overflow-hidden">
    <!-- Sophisticated Abstract Background Elements -->
    <div class="decor-blur-1"></div>
    <div class="decor-blur-2"></div>
    
    <div class="container position-relative z-index-1">
        <div class="row g-4 g-lg-5 align-items-center">
            <!-- Left Content -->
            <div class="col-lg-6 text-center text-lg-start">
                <span class="badge bg-primary-soft text-primary fw-semibold px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fs-12 border border-primary-100">
                    <i class="fe fe-award me-1"></i> Professional Training
                </span>
                <h1 class="display-4 fw-black text-slate-900 mb-3 lh-sm">
                    Master the Skills with <br class="d-none d-md-inline"><span class="text-gradient">MSM Course</span>
                </h1>
                <p class="lead text-slate-700 mb-4 px-2 px-lg-0 mx-auto mx-lg-0 max-w-500 fw-medium">
                    Join thousands of successful students and transform your career with our industry-leading modules. Expert-led training designed for modern professionals.
                </p>
                
                <!-- Quick Stats -->
                <div class="row g-3 justify-content-center justify-content-lg-start max-w-450 mx-auto mx-lg-0 mb-4 mb-lg-0">
                    <div class="col-6 col-sm-5">
                        <div class="d-flex align-items-center bg-white p-3 rounded-20 shadow-premium border border-white">
                            <div class="stat-icon bg-primary-soft text-primary me-3">
                                <i class="fe fe-users fs-5"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold text-slate-900 mb-0">5k+</h4>
                                <small class="text-muted fw-medium">Students</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-5">
                        <div class="d-flex align-items-center bg-white p-3 rounded-20 shadow-premium border border-white">
                            <div class="stat-icon bg-warning-soft text-warning me-3">
                                <i class="fe fe-star fs-5"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold text-slate-900 mb-0">4.9</h4>
                                <small class="text-muted fw-medium">Rating</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Form Card -->
            <div class="col-lg-6">
                <div class="card border-0 modern-glass-card rounded-32 p-4 p-sm-5 mx-auto max-w-550">
                    <div class="text-center text-lg-start mb-4">
                        <h3 class="fw-bold text-slate-900 mb-1">Inquiry / Enrollment</h3>
                        <p class="text-slate-600 small mb-0">Fill up the form to secure your seat today.</p>
                    </div>
                    
                    <form action="{{ route('course.enroll') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $featured_course->id ?? 1 }}">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-slate-700 fw-semibold small">Select Module (Optional)</label>
                                <div class="input-group-custom">
                                    <select class="form-select custom-input text-slate-800">
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-slate-700 fw-semibold small">Your Name</label>
                                <input type="text" name="name" class="form-control custom-input" placeholder="Full Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-slate-700 fw-semibold small">Phone</label>
                                <input type="text" name="phone" class="form-control custom-input" placeholder="01XXXXXXXXX" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-slate-700 fw-semibold small">Email</label>
                                <input type="email" name="email" class="form-control custom-input" placeholder="email@example.com" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-gradient-primary w-100 rounded-pill py-3 fw-bold text-white shadow-md hover-scale">
                                    Submit Request <i class="fe fe-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Course Modules Section -->
<section class="py-5 py-lg-6 bg-white">
    <div class="container">
        <div class="text-center max-w-600 mx-auto mb-5">
            <h2 class="fw-bold text-slate-900 mb-2 section-title position-relative d-inline-block">Available Course Modules</h2>
            <p class="text-muted small">Explore our specialized modules and pick the right one for your goals.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($courses as $course)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 modern-course-card bg-white rounded-24 overflow-hidden">
                    <div class="position-relative overflow-hidden card-img-wrapper">
                        <img src="{{ asset($course->image ?? 'default/course.jpg') }}" class="card-img-top transition-transform" alt="{{ $course->title }}">
                        @if($course->price)
                            <span class="badge bg-white text-primary price-tag fw-bold shadow-sm">
                                ৳{{ number_format($course->price) }}
                            </span>
                        @endif
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="fw-bold text-slate-800 mb-2 line-clamp-2 h-50px">{{ $course->title }}</h5>
                        <p class="text-muted small mb-4 flex-grow-1 line-clamp-3">
                            {{ Str::limit(strip_tags($course->description), 95) }}
                        </p>
                        <a href="{{ route('course.details', $course->id) }}" class="btn btn-outline-custom rounded-pill w-100 fw-semibold mt-auto">
                            Learn More <i class="fe fe-chevron-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Custom Professional Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-color: #4f46e5;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --light-bg: #f8fafc;
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #334155;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* Helper Utilities */
    .fw-black { font-weight: 800; }
    .text-slate-900 { color: var(--slate-900); }
    .text-slate-800 { color: var(--slate-800); }
    .text-slate-700 { color: var(--slate-700); }
    .max-w-450 { max-width: 450px; }
    .max-w-500 { max-width: 500px; }
    .max-w-550 { max-width: 550px; }
    .max-w-600 { max-width: 600px; }
    .rounded-32 { border-radius: 32px !important; }
    .rounded-24 { border-radius: 24px !important; }
    .rounded-20 { border-radius: 20px !important; }
    .tracking-wider { letter-spacing: 0.05em; }
    .fs-12 { font-size: 12px; }
    .h-50px { hieght: auto; min-height: 50px; }

    /* Gradient Effects */
    .bg-light-gradient {
        background: linear-gradient(180deg, #f1f5f9 0%, #ffffff 100%);
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

    /* Soft Badges & Icons */
    .bg-primary-soft { background-color: rgba(79, 70, 229, 0.08); }
    .bg-warning-soft { background-color: rgba(245, 158, 11, 0.1); }
    
    .stat-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    /* Decorative Circle */
    .bg-circle-shape {
        position: absolute;
        top: -20%;
        right: -10%;
        width: 600px;
        height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(216, 217, 231, 0.05) 0%, rgba(207, 201, 201, 0) 70%);
        z-index: 0;
        pointer-events: none;
    }

    /* Form Design Upgrade */
    .glass-card {
        background: #ffffff;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06) !important;
        border: 1px solid #f1f5f9 !important;
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
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
        color: var(--slate-900);
    }

    /* Modern Course Cards */
    .modern-course-card {
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.03);
        border: 1px solid #f1f5f9 !important;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
    }
    .modern-course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px rgba(15, 23, 42, 0.08);
    }
    .card-img-wrapper {
        height: 210px;
    }
    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .modern-course-card:hover .card-img-wrapper img {
        transform: scale(1.05);
    }
    .transition-transform {
        transition: transform 0.5s ease;
    }
    .price-tag {
        position: absolute;
        bottom: 15px;
        right: 15px;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.9rem;
    }

    /* Buttons & Interactions */
    .btn-outline-custom {
        color: var(--primary-color);
        border: 1px solid #e2e8f0;
        padding: 10px 20px;
        transition: all 0.2s ease;
    }
    .btn-outline-custom:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    .hover-scale {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-scale:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2) !important;
    }

    /* Line Clamp to Keep Heights Even */
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

    /* Responsive Section Title Underline */
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    /* Mobile Responsive Media Queries */
    @media (max-width: 991.98px) {
        .py-lg-7 { padding-top: 4rem; padding-bottom: 4rem; }
        .display-4 { font-size: 2.25rem !important; }
    }
    
    @media (max-width: 576px) {
        .display-4 { font-size: 1.85rem !important; }
        .card-img-wrapper { height: 180px; }
        .card.p-sm-5 { padding: 1.25rem !important; }
        .glass-card { border-radius: 24px !important; }
    }
</style>
<!-- এই স্টাইলগুলো আগের <style> ট্যাগের ভেতর যোগ বা রিপ্লেস করে নিবেন -->
<style>
    /* New Simple Yet Gorgeous Background Styling */
    .bg-premium-modern {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    /* Soft Tech Blur Elements (Gorgeous & Non-distracting) */
    .decor-blur-1 {
        position: absolute;
        top: -10%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: rgba(99, 102, 241, 0.04);
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
        background: rgba(124, 58, 237, 0.03);
        filter: blur(120px);
        border-radius: 50%;
        pointer-events: none;
    }

    /* High Visibility Text Tweak */
    .text-slate-700 {
        color: #475569 !important; /* টেক্সট রিডাবিলিটি আরও নিখুঁত করার জন্য */
    }

    /* Card Shadow & Border Update for Maximum POP-UP Effect */
    .modern-glass-card {
        background: #ffffff !important;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.8) !important;
    }
    
    .shadow-premium {
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.04) !important;
    }

    .border-primary-100 {
        border-color: rgba(99, 102, 241, 0.15) !important;
    }
</style>
@endsection