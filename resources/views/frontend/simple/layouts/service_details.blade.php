@extends('frontend.simple.app', ['title' => $service->title])

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-20 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 bg-primary d-flex align-items-center justify-content-center p-5 text-white">
                            <div class="text-center animate__animated animate__fadeInLeft">
                                <i class="fe fe-briefcase display-1 mb-4"></i>
                                <h2 class="fw-bold mb-3">Our Services</h2>
                                <p class="lead opacity-75">Professional solutions tailored for your business growth and digital presence.</p>
                                <div class="mt-5 d-none d-md-block">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fe fe-check-circle me-3 fs-20"></i>
                                        <span>24/7 Expert Support</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fe fe-check-circle me-3 fs-20"></i>
                                        <span>Customized Solutions</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fe fe-check-circle me-3 fs-20"></i>
                                        <span>Proven Results</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-5 animate__animated animate__fadeInRight">
                                <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill mb-3 text-uppercase fw-bold ls-1">Service Details</span>
                                <h1 class="fw-bold mb-4 display-6 text-dark">{{ $service->title }}</h1>
                                
                                <div class="text-muted lead mb-5">
                                    {!! $service->description !!}
                                </div>

                                <hr class="my-5 opacity-10">

                                <h4 class="fw-bold mb-4">Request a Consultation</h4>
                                <form action="{{ route('service.request') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="name" class="form-control border-light rounded-12" id="floatingName" placeholder="John Doe" required>
                                                <label for="floatingName">Full Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="phone" class="form-control border-light rounded-12" id="floatingPhone" placeholder="01XXXXXXXXX" required>
                                                <label for="floatingPhone">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="address" class="form-control border-light rounded-12" id="floatingAddress" placeholder="Dhaka, Bangladesh" required>
                                                <label for="floatingAddress">City/Area</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-lg mt-3">
                                                Submit Request <i class="fe fe-send ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <p class="text-center text-muted small mt-4">We typically respond within 24 hours.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .fs-20 { font-size: 20px; }
    .bg-primary-soft { background-color: rgba(78, 115, 223, 0.1); }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
    }
</style>
@endsection
