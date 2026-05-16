@extends('frontend.simple.app', ['title' => 'Blog'])

@section('content')
<!-- Premium Blog Section -->
<section class="py-5 py-lg-7 bg-premium-light-gray position-relative overflow-hidden">
    <!-- Subtle Ambient Accents -->
    <div class="decor-blur-soft-1"></div>
    <div class="decor-blur-soft-2"></div>

    <div class="container position-relative z-index-1">
        <!-- Section Header -->
        <div class="text-center max-w-600 mx-auto mb-5 animate__animated animate__fadeInDown">
            <span class="badge bg-primary-soft text-primary fw-semibold px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fs-11 border border-primary-100">
                <i class="fe fe-book-open me-1"></i> Our Blog
            </span>
            <h2 class="display-5 fw-black text-slate-900 mb-2">Latest News & Insights</h2>
            <p class="text-slate-600 small-90">Stay ahead of the curve with our curated tech guides, rare discoveries, and masterclasses.</p>
            <div class="title-bar-center mx-auto mt-3"></div>
        </div>

        <!-- Blog Grid Content -->
        <div class="row g-4 justify-content-center">
            @forelse($posts as $post)
            <div class="col-sm-6 col-md-4">
                <div class="card h-100 border-0 shadow-premium bg-white rounded-24 overflow-hidden modern-post-card border border-slate-100">
                    <!-- Image Wrapper with Dynamic Date Badge & Overlays -->
                    <div class="position-relative overflow-hidden card-img-wrapper-blog">
                        <img src="{{ asset($post->thumbnail) }}" class="w-100 h-100 object-fit-cover transition-transform" alt="{{ $post->title }}">
                        <div class="img-gradient-overlay-blog"></div>
                        
                        <!-- Floating Glassmorphic Date Badge -->
                        <div class="post-date-badge text-center text-white d-flex flex-column justify-content-center">
                            <span class="fw-black fs-18 mb-0 d-block lh-1">{{ $post->created_at->format('d') }}</span>
                            <span class="text-uppercase tracking-wider font-medium text-white-80 fs-10 mt-0.5">{{ $post->created_at->format('M') }}</span>
                        </div>
                    </div>
                    
                    <!-- Card Body Meta & Content -->
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2.5 text-slate-400 fs-12 fw-medium">
                            <span><i class="fe fe-clock me-1"></i> 5 min read</span>
                            <span>•</span>
                            <span><i class="fe fe-eye me-1"></i> {{ rand(120, 450) }} Views</span>
                        </div>
                        
                        <h4 class="fw-bold text-slate-800 mb-2 line-clamp-2 fs-18 lh-sm h-48px">
                            {{ $post->title }}
                        </h4>
                        
                        <p class="text-slate-600 mb-4 line-clamp-3 fs-14 lh-relaxed">
                            {{ Str::limit(strip_tags($post->description), 120) }}
                        </p>
                        
                        <!-- Premium Styled Action Button -->
                        <div class="mt-auto pt-2">
                            <a href="{{ route('post.show', $post->slug) }}" class="btn btn-outline-blog rounded-pill w-100 py-2.5 fw-bold text-center fs-14 transition-all">
                                Read More <i class="fe fe-arrow-right ms-1.5 transition-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Beautiful Empty State Minimalist Design -->
            <div class="col-12 text-center py-6 animate__animated animate__fadeInUp">
                <div class="empty-state-icon bg-white shadow-premium mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle border border-slate-100" style="width: 80px; height: 80px;">
                    <i class="fe fe-edit-3 fs-32 text-slate-300"></i>
                </div>
                <h3 class="text-slate-800 fw-bold fs-22 mb-1">No posts available yet</h3>
                <p class="text-slate-500 small max-w-400 mx-auto">We're cooking up some amazing articles. Check back shortly to dive in!</p>
                <a href="{{ route('home') }}" class="btn btn-gradient-primary rounded-pill px-4 py-2.5 fw-bold text-white shadow-md hover-scale mt-2">
                    <i class="fe fe-home me-1"></i> Back to Home
                </a>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Custom Professional Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-color: #4f46e5;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #475569;
        --slate-600: #64748b;
        --slate-400: #94a3b8;
        --slate-300: #cbd5e1;
        --slate-100: #f1f5f9;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* Modern Utilities */
    .fw-black { font-weight: 800; }
    .text-slate-600 { color: var(--slate-600) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .bg-premium-light-gray { background-color: #fafafa; }
    .rounded-24 { border-radius: 24px !important; }
    .tracking-wider { letter-spacing: 0.04em; }
    .max-w-400 { max-width: 400px; }
    .max-w-600 { max-width: 600px; }
    .fs-10 { font-size: 10px; }
    .fs-11 { font-size: 11px; }
    .fs-12 { font-size: 12px; }
    .fs-14 { font-size: 14px; }
    .fs-18 { font-size: 18px; }
    .fs-22 { font-size: 22px; }
    .fs-32 { font-size: 32px; }
    .small-90 { font-size: 0.88rem; }
    .mb-2\.5 { margin-bottom: 0.65rem !important; }
    .text-white-80 { color: rgba(255, 255, 255, 0.8) !important; }
    .h-48px { height: auto; min-height: 48px; } /* Ensures card heading layout alignment sync */

    /* Soft Gradient & Shadows */
    .shadow-premium {
        box-shadow: 0 12px 40px -10px rgba(15, 23, 42, 0.03) !important;
    }
    .bg-primary-soft { background-color: rgba(79, 70, 229, 0.08) !important; }
    .border-primary-100 { border-color: rgba(99, 102, 241, 0.15) !important; }
    .btn-gradient-primary {
        background: var(--primary-gradient);
        border: none;
    }

    /* Title Decorative Accent Bar */
    .title-bar-center {
        width: 40px; height: 3px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    /* Ambient Soft Lighting Effects */
    .decor-blur-soft-1 {
        position: absolute; top: -5%; left: -5%; width: 400px; height: 400px;
        background: rgba(99, 102, 241, 0.03); filter: blur(100px); border-radius: 50%; pointer-events: none;
    }
    .decor-blur-soft-2 {
        position: absolute; bottom: 5%; right: -5%; width: 400px; height: 400px;
        background: rgba(124, 58, 237, 0.03); filter: blur(100px); border-radius: 50%; pointer-events: none;
    }

    /* Card Frame Layout & Overlays */
    .modern-post-card {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
    }
    .modern-post-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px rgba(15, 23, 42, 0.06) !important;
    }
    .card-img-wrapper-blog {
        height: 240px;
    }
    .card-img-wrapper-blog img {
        transition: transform 0.5s ease;
    }
    .modern-post-card:hover .card-img-wrapper-blog img {
        transform: scale(1.05);
    }
    .img-gradient-overlay-blog {
        position: absolute; bottom: 0; left: 0; width: 100%; height: 50%;
        background: linear-gradient(180deg, rgba(15,23,42,0) 0%, rgba(15,23,42,0.4) 100%);
    }

    /* Premium Glass Date Badge Frame */
    .post-date-badge {
        position: absolute; top: 15px; left: 15px; z-index: 2;
        width: 52px; height: 56px;
        background: rgba(15, 23, 42, 0.65) !important;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 12px;
    }

    /* Outline Button & Arrow Interactions */
    .btn-outline-blog {
        color: var(--slate-700);
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
    }
    .btn-outline-blog:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #ffffff !important;
    }
    .transition-arrow {
        transition: transform 0.2s ease;
        display: inline-block;
    }
    .btn-outline-blog:hover .transition-arrow {
        transform: translateX(3px);
    }

    /* Clamp Utilities */
    .line-clamp-2 {
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }
    .hover-scale { transition: transform 0.2s ease; }
    .hover-scale:hover { transform: translateY(-2px); }

    /* Fluid Mobile Responsiveness Tweaks */
    @media (max-width: 991.98px) {
        .py-lg-7 { padding-top: 4rem; padding-bottom: 4rem; }
        .display-5 { font-size: 2.15rem !important; }
    }
    @media (max-width: 576px) {
        .display-5 { font-size: 1.75rem !important; }
        .card-img-wrapper-blog { height: 200px; }
        .card-body.p-4 { padding: 1.25rem !important; }
        .row.g-4 > [class*='col-'] { padding-left: 10px; padding-right: 10px; } /* Mobile grid container sync */
    }
</style>
@endsection