@extends('frontend.simple.app', ['title' => $title])

@section('content')
<section class="py-6 bg-slate-50 border-bottom border-slate-100">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase fw-bold ls-2 mb-3">Premium Collection</h6>
                <h1 class="display-4 fw-bold text-dark mb-4">{{ $title }}</h1>
                <p class="fs-5 text-secondary mb-5">Explore our handpicked selection of high-quality items. Whether you're looking for the latest tech or rare finds, we have something special for you.</p>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary-soft p-3 rounded-circle me-3"><i class="fe fe-award text-primary fs-20"></i></div>
                    <span class="fw-bold text-dark">Quality Guaranteed</span>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary-soft p-3 rounded-circle me-3"><i class="fe fe-truck text-primary fs-20"></i></div>
                    <span class="fw-bold text-dark">Fast & Secure Shipping</span>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-32 p-4 p-md-5 bg-white">
                    <h3 class="fw-bold text-dark mb-4">Quick Order / Inquiry</h3>
                    <form action="{{ route('product.order') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-dark fw-bold">Select Item (Optional)</label>
                                <select name="product_id" class="form-select bg-slate-50 border-slate-200 py-3 rounded-12 text-dark">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
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
                                <label class="form-label text-dark fw-bold">Address</label>
                                <input type="text" name="address" class="form-control bg-slate-50 border-slate-200 py-3 rounded-12 text-dark" placeholder="Shipping Address" required>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-lg">Confirm Inquiry <i class="fe fe-shopping-cart ms-2"></i></button>
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
        <h2 class="fw-bold text-slate-900 mb-5">Current Collection</h2>
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm rounded-24 overflow-hidden product-mini-card">
                    <img src="{{ asset($product->thumbnail) }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-slate-800 mb-2">{{ $product->title }}</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">${{ $product->price - $product->discount }}</span>
                            <a href="{{ route('product.details', $product->slug) }}" class="btn btn-link text-decoration-none p-0">View <i class="fe fe-arrow-right"></i></a>
                        </div>
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
    .product-mini-card { transition: all 0.3s ease; }
    .product-mini-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }

    @media (max-width: 576px) {
        .display-4 { font-size: 2rem !important; }
        .fs-5 { font-size: 1rem !important; }
        .card.p-md-5 { padding: 1.5rem !important; }
        .py-6 { padding-top: 3rem; padding-bottom: 3rem; }
    }
</style>
@endsection
