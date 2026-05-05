@extends('frontend.simple.app', ['title' => $course->title])

@section('content')
<!-- Course Header -->
<section class="py-5 bg-dark text-white position-relative overflow-hidden">
    <div class="banner-overlay opacity-50"></div>
    <div class="container position-relative z-index-2 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-4 animate__animated animate__fadeInDown">NEW COURSE</span>
                <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp">{{ $course->title }}</h1>
                <p class="lead mb-5 text-white-50 animate__animated animate__fadeInUp animate__delay-1s">{{ Str::limit(strip_tags($course->description), 200) }}</p>
                <div class="d-flex align-items-center animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="me-4">
                        <i class="fe fe-users text-primary fs-24 me-2"></i>
                        <span class="fw-bold">{{ rand(100, 500) }}+ Students</span>
                    </div>
                    <div class="me-4">
                        <i class="fe fe-clock text-primary fs-24 me-2"></i>
                        <span class="fw-bold">12+ Hours</span>
                    </div>
                    <div>
                        <i class="fe fe-award text-primary fs-24 me-2"></i>
                        <span class="fw-bold">Certificate</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 animate__animated animate__fadeInRight">
                <div class="card border-0 shadow-lg rounded-20 overflow-hidden">
                    <img src="{{ asset($course->image ?? 'default/course.jpg') }}" class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body p-4 bg-white text-dark text-center">
                        @if($course->price)
                            <h2 class="fw-bold text-primary mb-3">${{ $course->price }}</h2>
                        @endif
                        <a href="#enroll-form" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold">Enroll in Course</a>
                        <p class="small text-muted mt-3 mb-0"><i class="fe fe-shield me-1"></i> 30-Day Money Back Guarantee</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Content -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Overview -->
                <div class="card border-0 shadow-sm rounded-20 p-4 mb-4">
                    <h3 class="fw-bold mb-4">Course Overview</h3>
                    <div class="text-muted lead">
                        {!! $course->description !!}
                    </div>
                </div>

                <!-- Curriculum -->
                <div class="card border-0 shadow-sm rounded-20 p-4 mb-4">
                    <h3 class="fw-bold mb-4">Course Curriculum</h3>
                    <div class="accordion accordion-flush" id="curriculumAccordion">
                        @forelse($course->curricula as $key => $module)
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-12 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }} fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#module{{ $key }}">
                                    <i class="fe fe-play-circle text-primary me-3"></i> {{ $module->title }}
                                </button>
                            </h2>
                            <div id="module{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" data-bs-parent="#curriculumAccordion">
                                <div class="accordion-body text-muted">
                                    {!! $module->description !!}
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">Curriculum details coming soon.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Enroll Form -->
                <div id="enroll-form" class="card border-0 shadow-lg rounded-20 p-4 sticky-top" style="top: 100px;">
                    <h4 class="fw-bold mb-4 text-center">Enrollment Form</h4>
                    <form action="{{ route('course.enroll') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control rounded-pill border-light px-4" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-pill border-light px-4" placeholder="email@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Phone Number</label>
                            <input type="text" name="phone" class="form-control rounded-pill border-light px-4" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Current Address</label>
                            <textarea name="address" class="form-control rounded-20 border-light px-4 py-3" rows="2" placeholder="Full Address" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 mt-3 fw-bold shadow-lg">Submit Enrollment</button>
                    </form>
                    <div class="mt-4 text-center small text-muted">
                        <p><i class="fe fe-info me-1"></i> You will receive a confirmation email shortly after submission.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .z-index-2 { z-index: 2; }
    .banner-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
    }
    .fs-24 { font-size: 24px; }
    .accordion-button:not(.collapsed) {
        background-color: rgba(78, 115, 223, 0.05);
        color: #4e73df;
    }
    @media (max-width: 991px) {
        .sticky-top { position: static !important; }
        .display-4 { font-size: 2.2rem !important; }
    }
    @media (max-width: 576px) {
        .display-4 { font-size: 1.8rem !important; }
        .lead { font-size: 1rem !important; }
        .fs-24 { font-size: 20px; }
        .d-flex.align-items-center > div { margin-right: 1rem !important; }
        .card.p-4 { padding: 1.25rem !important; }
        .container.py-5 { padding-top: 2rem !important; padding-bottom: 2rem !important; }
    }
</style>
@endsection
