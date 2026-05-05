@extends('frontend.simple.app', ['title' => $product->title])

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('home', ['category' => $product->category->slug ?? '']) }}">{{ $product->category->name ?? 'Products' }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-20 overflow-hidden">
                    <img src="{{ asset($product->thumbnail) }}" class="img-fluid" alt="{{ $product->title }}">
                </div>
                @if($product->images && count($product->images) > 0)
                <div class="row g-3 mt-3">
                    @foreach($product->images as $img)
                    <div class="col-3">
                        <div class="card border-0 shadow-sm rounded-12 overflow-hidden">
                            <img src="{{ asset($img->image) }}" class="img-fluid" alt="Gallery">
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-info-card p-4 bg-white shadow-sm rounded-20 h-100">
                    <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill mb-3">{{ $product->category->name ?? 'Mixed' }}</span>
                    <h1 class="fw-bold mb-3 display-6">{{ $product->title }}</h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="text-warning me-3">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span class="text-muted ms-2">(4.5/5)</span>
                        </div>
                        <div class="text-muted small">| {{ rand(50, 200) }} Reviews</div>
                    </div>

                    <div class="price-box mb-4">
                        @if($product->discount > 0)
                            <h2 class="text-primary fw-bold mb-0">৳{{ $product->price - $product->discount }}</h2>
                            <p class="text-muted text-decoration-line-through mb-0">Original Price: ৳{{ $product->price }}</p>
                            <span class="badge bg-danger rounded-pill mt-2">Save ৳{{ $product->discount }} OFF</span>
                        @else
                            <h2 class="text-primary fw-bold mb-0">৳{{ $product->price }}</h2>
                        @endif
                    </div>

                    <div class="description mb-5 text-muted lead">
                        {!! $product->description ?? 'No description available for this product.' !!}
                    </div>

                    <hr class="my-5 opacity-10">

                    <!-- Order Form -->
                    <div class="order-form-box p-4 bg-light rounded-20 border border-primary border-opacity-10">
                        <h4 class="fw-bold mb-4"><i class="fe fe-shopping-cart me-2 text-primary"></i>Place Your Order</h4>
                        <form action="{{ route('product.order') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-uppercase">Full Name</label>
                                    <input type="text" name="name" class="form-control rounded-pill border-0 shadow-sm px-4" placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-uppercase">Phone Number</label>
                                    <input type="text" name="phone" class="form-control rounded-pill border-0 shadow-sm px-4" placeholder="01XXXXXXXXX" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-uppercase">Shipping Address</label>
                                    <textarea name="address" class="form-control rounded-20 border-0 shadow-sm px-4 py-3" rows="3" placeholder="Enter your full address" required></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-lg shadow-primary-30">
                                        Confirm Order Now <i class="fe fe-check-circle ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .rounded-20 { border-radius: 20px !important; }
    .rounded-12 { border-radius: 12px !important; }
    .bg-primary-soft { background-color: rgba(78, 115, 223, 0.1); }
    .shadow-primary-30 { box-shadow: 0 10px 30px rgba(78, 115, 223, 0.3) !important; }
    .ls-1 { letter-spacing: 1px; }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\e930";
        font-family: 'feather';
        font-size: 12px;
        vertical-align: middle;
    }
    @media (max-width: 576px) {
        .display-6 { font-size: 1.5rem !important; }
        .lead { font-size: 1rem !important; }
        .product-info-card { padding: 1.25rem !important; }
        .order-form-box { padding: 1.25rem !important; }
        .py-5 { padding-top: 2rem !important; padding-bottom: 2rem !important; }
    }
</style>
@endsection
