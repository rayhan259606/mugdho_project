@extends('frontend.simple.app', ['title' => 'Our Services'])

@section('content')
<section class="py-10 text-white position-relative overflow-hidden" style="background-color: #0f172a !important; min-height: 500px;">
    <div class="container position-relative z-index-2">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4 text-white">Enterprise <span class="text-primary">Business Services</span></h1>
                <p class="fs-4 mb-5 text-white opacity-75">Scaling your business with world-class solutions. From strategic consulting to digital transformation, we help you stay ahead.</p>
                
                <div class="d-flex gap-4 mb-5">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary p-2 rounded-circle me-3"><i class="fe fe-check text-white"></i></div>
                        <span class="text-white fw-500">24/7 Support</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-primary p-2 rounded-circle me-3"><i class="fe fe-check text-white"></i></div>
                        <span class="text-white fw-500">Expert Team</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-32 p-4 p-md-5 bg-white">
                    <h3 class="fw-bold text-dark mb-4">Service Inquiry Form</h3>
                    <form action="{{ route('service.request') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-dark fw-bold">Interested Service</label>
                                <select name="service_id" class="form-select bg-slate-50 border-slate-200 py-3 rounded-12 text-dark">
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-dark fw-bold">Company Name</label>
                                <input type="text" name="company_name" class="form-control bg-slate-50 border-slate-200 py-3 rounded-12 text-dark" placeholder="Your Company" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-bold">Contact Name</label>
                                <input type="text" name="name" class="form-control bg-slate-50 border-slate-200 py-3 rounded-12 text-dark" placeholder="Full Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-bold">Phone Number</label>
                                <input type="text" name="phone" class="form-control bg-slate-50 border-slate-200 py-3 rounded-12 text-dark" placeholder="01XXXXXXXXX" required>
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
        <h2 class="fw-bold text-dark text-center mb-5 display-6">Our Core Offerings</h2>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-24 p-4 service-hover-card">
                    <div class="bg-primary-soft p-3 rounded-16 w-max-content mb-4">
                        <i class="fe fe-activity text-primary fs-32"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">{{ $service->title }}</h4>
                    <p class="text-secondary mb-4">{{ Str::limit(strip_tags($service->description), 120) }}</p>
                    <a href="{{ route('service.details', $service->id) }}" class="btn btn-navy-soft rounded-pill px-4">View Details <i class="fe fe-chevron-right ms-2"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .w-max-content { width: max-content; }
    .rounded-16 { border-radius: 16px !important; }
    .service-hover-card {
        transition: all 0.3s ease;
        border: 1px solid transparent !important;
    }
    .service-hover-card:hover {
        transform: translateY(-10px);
        border-color: var(--primary) !important;
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.1) !important;
    }
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
    }
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--primary);
        box-shadow: none;
    }
    .btn-navy-soft {
        background: rgba(15, 23, 42, 0.05);
        color: #0f172a;
        font-weight: 600;
    }
    .btn-navy-soft:hover {
        background: #0f172a;
        color: #fff;
    }

    @media (max-width: 576px) {
        .display-3 { font-size: 2.2rem !important; }
        .display-6 { font-size: 1.8rem !important; }
        .fs-4 { font-size: 1.1rem !important; }
        .py-10 { padding-top: 4rem !important; padding-bottom: 4rem !important; }
        .py-6 { padding-top: 3rem !important; padding-bottom: 3rem !important; }
        .gap-4 { gap: 1rem !important; flex-direction: column !important; }
        .card.p-md-5 { padding: 1.25rem !important; }
    }
</style>
@endsection
