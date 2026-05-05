@extends('frontend.simple.app', ['title' => 'MSM Course'])

@section('content')
<section class="py-6 bg-slate-50">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase fw-bold ls-2 mb-3">Professional Training</h6>
                <h1 class="display-4 fw-bold text-dark mb-4">Master the Skills with <span class="text-primary">MSM Course</span></h1>
                <p class="fs-5 text-secondary mb-5">Join thousands of students and transform your career with our industry-leading modules. Expert-led training designed for modern professionals.</p>
                
                <div class="row g-4 mb-5">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-soft p-3 rounded-circle me-3"><i class="fe fe-users text-primary fs-20"></i></div>
                            <div>
                                <h4 class="fw-bold text-dark mb-0">5k+</h4>
                                <small class="text-secondary">Students</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-soft p-3 rounded-circle me-3"><i class="fe fe-star text-primary fs-20"></i></div>
                            <div>
                                <h4 class="fw-bold text-dark mb-0">4.9</h4>
                                <small class="text-secondary">Rating</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-32 p-4 p-md-5 bg-white">
                    <h3 class="fw-bold text-dark mb-4">Inquiry / Enrollment</h3>
                    <form action="{{ route('course.enroll') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $featured_course->id ?? 1 }}">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-dark fw-bold">Select Module (Optional)</label>
                                <select class="form-select bg-slate-50 border-slate-200 py-3 rounded-12 text-dark">
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-dark fw-bold">Your Name</label>
                                <input type="text" name="name" class="form-control bg-slate-50 border-slate-200 py-3 rounded-12 text-dark" placeholder="Full Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-bold">Phone</label>
                                <input type="text" name="phone" class="form-control bg-slate-50 border-slate-200 py-3 rounded-12 text-dark" placeholder="01XXXXXXXXX" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-bold">Email</label>
                                <input type="email" name="email" class="form-control bg-slate-50 border-slate-200 py-3 rounded-12 text-dark" placeholder="email@example.com" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-lg">Submit Request <i class="fe fe-send ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-6 bg-white">
    <div class="container">
        <h2 class="fw-bold text-slate-900 mb-5">Available Course Modules</h2>
        <div class="row g-4">
            @foreach($courses as $course)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-24 overflow-hidden course-mini-card">
                    <img src="{{ asset($course->image ?? 'default/course.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-slate-800 mb-2">{{ $course->title }}</h5>
                        @if($course->price)
                            <h6 class="fw-bold text-primary mb-3">${{ $course->price }}</h6>
                        @endif
                        <p class="text-slate-500 small mb-4">{{ Str::limit(strip_tags($course->description), 100) }}</p>
                        <a href="{{ route('course.details', $course->id) }}" class="btn btn-outline-primary rounded-pill w-100">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .rounded-32 { border-radius: 32px !important; }
    .rounded-12 { border-radius: 12px !important; }
    .rounded-24 { border-radius: 24px !important; }
    .bg-primary-soft { background-color: rgba(99, 102, 241, 0.1); }
    .course-mini-card { transition: all 0.3s ease; }
    .course-mini-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
</style>
@endsection
