@extends('frontend.simple.app', ['title' => $post->title])

@section('content')
<!-- Premium Single Blog View Section -->
<section class="py-4 py-md-6 bg-premium-light-gray position-relative overflow-hidden">
    <!-- Subtle Ambient Accents -->
    <div class="decor-blur-soft-1"></div>
    <div class="decor-blur-soft-2"></div>

    <div class="container position-relative z-index-1">
        <div class="row justify-content-center">
            <div class="col-lg-9 animate__animated animate__fadeIn">
                
                <!-- Advanced Breadcrumb Navigation -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb custom-modern-breadcrumb bg-white px-3 py-2 rounded-pill shadow-premium d-inline-flex border border-slate-100">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-slate-500 hover-primary"><i class="fe fe-home me-1"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('post.index') }}" class="text-slate-500 hover-primary">Blog</a></li>
                        <li class="breadcrumb-item active text-slate-800 fw-semibold" aria-current="page">{{ Str::limit($post->title, 20) }}</li>
                    </ol>
                </nav>

                <!-- High-End Hero Header Frame -->
                <div class="post-meta-header mb-4">
                    <h1 class="display-5 fw-black text-slate-900 mb-3 lh-sm text-balance">
                        {{ $post->title }}
                    </h1>
                    
                    <div class="d-flex align-items-center flex-wrap gap-3 text-slate-500 fs-14 border-bottom border-slate-200 pb-4">
                        <div class="d-flex align-items-center bg-white px-3 py-1.5 rounded-pill shadow-premium border border-slate-100">
                            <i class="fe fe-calendar text-primary me-2"></i>
                            <span class="fw-medium text-slate-700">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex align-items-center bg-white px-3 py-1.5 rounded-pill shadow-premium border border-slate-100">
                            <i class="fe fe-user text-primary me-2"></i>
                            <span class="fw-medium text-slate-700">By Admin</span>
                        </div>
                        {{-- <div class="d-flex align-items-center bg-white px-3 py-1.5 rounded-pill shadow-premium border border-slate-100 ms-sm-auto">
                            <i class="fe fe-clock text-primary me-2"></i>
                            <span class="fw-medium text-slate-700">5 Min Read</span>
                        </div> --}}
                    </div>
                </div>

                <!-- Premium Main Feature Image Display -->
                <div class="card border-0 shadow-premium rounded-28 overflow-hidden bg-white p-2 border border-slate-100 mb-5 animate__animated animate__zoomIn">
                    <div class="position-relative card-main-hero-wrap rounded-24 overflow-hidden">
                        <img src="{{ asset($post->thumbnail) }}" class="w-100 h-100 object-fit-cover" alt="{{ $post->title }}">
                        <div class="img-ambient-darkener"></div>
                    </div>
                </div>
                
                <!-- Editorial Standard Rich Text Content Container -->
                <article class="post-content-typography text-slate-800 mb-5 px-1 px-md-3">
                    {!! $post->description !!}
                </article>

                <!-- Modern Conversational Share & Engagement Box -->
                <div class="share-box p-3 p-sm-4 bg-white border border-slate-100 rounded-24 shadow-premium d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 mb-5">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="share-icon-pulse">
                            <i class="fe fe-share-2 text-primary fs-16"></i>
                        </div>
                        <h5 class="fw-bold text-slate-900 mb-0 fs-16">Enjoyed reading? Share with others</h5>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-social-pill share-fb transition-all" aria-label="Share on Facebook">
                            <i class="fe fe-facebook me-2"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-social-pill share-tw transition-all" aria-label="Share on Twitter">
                            <i class="fe fe-twitter me-2"></i> Twitter
                        </a>
                    </div>
                </div>

                <!-- Strategic Back Route Action Navigation -->
                <div class="text-center pt-2">
                    <a href="{{ route('post.index') }}" class="btn btn-outline-blog-back rounded-pill px-4 py-2.5 fw-bold text-center fs-14 transition-all">
                        <i class="fe fe-arrow-left me-2 transition-arrow-back"></i> Back to All Articles
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Custom Editorial Architecture Typography & Layout System -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,400..700;1,400..700&display=swap');

    :root {
        --primary-color: #4f46e5;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #334155;
        --slate-500: #64748b;
        --slate-100: #f1f5f9;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* Minimal Layout Helpers */
    .fw-black { font-weight: 800; }
    .text-slate-500 { color: var(--slate-500) !important; }
    .text-slate-700 { color: var(--slate-700) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .bg-premium-light-gray { background-color: #fafafa; }
    .rounded-28 { border-radius: 28px !important; }
    .rounded-24 { border-radius: 24px !important; }
    .text-balance { text-wrap: balance; }
    .fs-14 { font-size: 14px; }
    .fs-16 { font-size: 16px; }

    /* Micro Shadow Matrices */
    .shadow-premium {
        box-shadow: 0 12px 40px -10px rgba(15, 23, 42, 0.03) !important;
    }

    /* Ambient Lighting Graphics */
    .decor-blur-soft-1 {
        position: absolute; top: -10%; left: -5%; width: 450px; height: 450px;
        background: rgba(99, 102, 241, 0.03); filter: blur(120px); border-radius: 50%; pointer-events: none;
    }
    .decor-blur-soft-2 {
        position: absolute; bottom: 10%; right: -5%; width: 450px; height: 450px;
        background: rgba(124, 58, 237, 0.03); filter: blur(120px); border-radius: 50%; pointer-events: none;
    }

    /* Custom Modern Breadcrumb Overrides */
    .custom-modern-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        content: "\e930" !important;
        font-family: 'feather' !important;
        font-size: 11px;
        color: #cbd5e1;
        vertical-align: middle;
    }
    .hover-primary { transition: color 0.2s ease; text-decoration: none; }
    .hover-primary:hover { color: var(--primary-color) !important; }

    /* Media Hero Framework */
    .card-main-hero-wrap {
        height: 480px;
    }
    .img-ambient-darkener {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.01); pointer-events: none;
    }

    /* ==========================================================================
       Editorial Typography Engine (Increases Content Reading Session Times)
       ========================================================================== */
    .post-content-typography {
        font-family: 'Lora', Georgia, serif !important;
        font-size: 1.2rem !important;
        line-height: 1.9 !important;
        color: #2d3748 !important;
    }
    .post-content-typography p {
        margin-bottom: 1.8rem !important;
    }
    .post-content-typography h2, 
    .post-content-typography h3, 
    .post-content-typography h4 {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-weight: 700;
        color: var(--slate-900);
        margin-top: 2.2rem !important;
        margin-bottom: 1rem !important;
        line-height: 1.3;
    }
    .post-content-typography h2 { font-size: 1.85rem; }
    .post-content-typography h3 { font-size: 1.5rem; }
    
    /* Responsive Content Image Framework */
    .post-content-typography img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 16px !important;
        margin: 2rem 0 !important;
        box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.04) !important;
    }
    
    /* Blockquote Design Refresh */
    .post-content-typography blockquote {
        border-left: 4px solid var(--primary-color) !important;
        padding: 0.5rem 0 0.5rem 1.5rem !important;
        margin: 2rem 0 !important;
        font-style: italic;
        color: var(--slate-700);
        background-color: var(--slate-100);
        border-radius: 0 12px 12px 0;
    }

    /* Premium Social Link Buttons */
    .btn-social-pill {
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        font-size: 13px;
        font-weight: 600;
        background-color: #ffffff;
        color: var(--slate-800);
        display: inline-flex;
        align-items: center;
    }
    .share-fb:hover { background-color: #1877f2; border-color: #1877f2; color: #ffffff !important; }
    .share-tw:hover { background-color: #1da1f2; border-color: #1da1f2; color: #ffffff !important; }

    /* Animated Pulse Core Element */
    .share-icon-pulse {
        width: 36px; height: 36px; background-color: rgba(79, 70, 229, 0.08);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        animation: meta-wave-pulse 2.5s infinite;
    }

    @keyframes meta-wave-pulse {
        0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.2); }
        70% { box-shadow: 0 0 0 8px rgba(79, 70, 229, 0); }
        100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
    }

    /* Return Navigation Action Rules */
    .btn-outline-blog-back {
        color: var(--slate-700); background-color: #ffffff; border: 1px solid #e2e8f0;
    }
    .btn-outline-blog-back:hover {
        background-color: var(--slate-900); border-color: var(--slate-900); color: #ffffff !important;
    }
    .transition-arrow-back { transition: transform 0.2s ease; display: inline-block; }
    .btn-outline-blog-back:hover .transition-arrow-back { transform: translateX(-3px); }

    /* Fluid Responsiveness Matrix Overrides */
    @media (max-width: 991.98px) {
        .card-main-hero-wrap { height: 360px; }
        .display-5 { font-size: 2rem !important; }
    }
    
    @media (max-width: 576px) {
        .py-md-6 { padding-top: 2rem; padding-bottom: 2rem; }
        .display-5 { font-size: 1.6rem !important; }
        .card-main-hero-wrap { height: 240px; }
        .post-content-typography { font-size: 1.1rem !important; line-height: 1.85 !important; }
        .post-content-typography h2 { font-size: 1.45rem; }
        .custom-modern-breadcrumb { font-size: 12px; padding: 6px 14px !important; }
    }
</style>
@endsection