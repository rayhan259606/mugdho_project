@extends('frontend.simple.app', ['title' => $page->title ?? 'Page'])

@section('content')
<!-- Premium Custom Dynamic Page Section -->
<section class="py-4 py-md-6 bg-premium-light-gray min-vh-100 position-relative overflow-hidden">
    <!-- Subtle Ambient Accents -->
    <div class="decor-blur-soft-1"></div>
    <div class="decor-blur-soft-2"></div>

    <div class="container position-relative z-index-1">
        <div class="row justify-content-center">
            <div class="col-lg-10 animate__animated animate__fadeIn">
                
                <!-- Advanced Capsule Breadcrumb Navigation -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb custom-modern-breadcrumb bg-white px-3 py-2 rounded-pill shadow-premium d-inline-flex border border-slate-100">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-slate-500 hover-primary"><i class="fe fe-home me-1"></i> Home</a></li>
                        <li class="breadcrumb-item active text-slate-800 fw-semibold" aria-current="page">{{ $page->title ?? 'Page' }}</li>
                    </ol>
                </nav>
                
                <!-- High-End Content Canvas -->
                <div class="card border-0 shadow-premium rounded-28 overflow-hidden bg-white border-gradient-wrapper">
                    <div class="card-body p-4 p-sm-5 bg-white">
                        
                        <!-- Page Main Header Title -->
                        <div class="page-title-header mb-4 mb-sm-5">
                            <h1 class="fw-black text-slate-900 display-5 lh-sm mb-3">
                                {{ $page->title ?? 'Untitled Page' }}
                            </h1>
                            <div class="title-bar-left"></div>
                        </div>
                        
                        <!-- Editorial Standard Dynamic Rich Text Output Container -->
                        <div class="page-dynamic-typography text-slate-800">
                            @if($page && $page->content)
                                {!! $page->content !!}
                            @else
                                <!-- Minimal Empty / Content Unavailable State -->
                                <div class="text-center py-5">
                                    <div class="empty-state-icon-soft mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle">
                                        <i class="fe fe-file-text fs-28 text-slate-300"></i>
                                    </div>
                                    <h4 class="text-slate-800 fw-bold fs-16 mb-1">Content Is Currently Empty</h4>
                                    <p class="text-slate-400 small max-w-300 mx-auto mb-3">The content for this section hasn't been uploaded from the admin panel yet.</p>
                                    <a href="{{ route('home') }}" class="btn btn-sm btn-gradient-primary rounded-pill px-3 py-2 fw-bold text-white shadow-sm">
                                        Go Back Home
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Custom Clean Design System Engine -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-color: #4f46e5;
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --slate-700: #334155;
        --slate-500: #64748b;
        --slate-400: #94a3b8;
        --slate-300: #cbd5e1;
        --slate-100: #f1f5f9;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    /* Core Micro Layout Modifiers */
    .fw-black { font-weight: 800; }
    .text-slate-400 { color: var(--slate-400) !important; }
    .text-slate-500 { color: var(--slate-500) !important; }
    .text-slate-800 { color: var(--slate-800) !important; }
    .text-slate-900 { color: var(--slate-900) !important; }
    .bg-premium-light-gray { background-color: #fafafa; }
    .rounded-28 { border-radius: 28px !important; }
    .max-w-300 { max-width: 300px; }
    .fs-16 { font-size: 16px; }
    .fs-28 { font-size: 28px; }

    /* Shadow Engineering */
    .shadow-premium {
        box-shadow: 0 12px 40px -10px rgba(15, 23, 42, 0.03) !important;
    }
    .btn-gradient-primary {
        background: var(--primary-gradient);
        border: none;
    }

    /* Elegant Top Border Gradient Accent */
    .border-gradient-wrapper {
        border: 1px solid var(--slate-100) !important;
        position: relative;
    }
    .border-gradient-wrapper::before {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px;
        background: var(--primary-gradient); z-index: 2;
    }

    /* Title Graphic Line Accent */
    .title-bar-left {
        width: 45px; height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    /* Background Ambient Soft Lighting Lights */
    .decor-blur-soft-1 {
        position: absolute; top: -5%; left: -5%; width: 400px; height: 400px;
        background: rgba(99, 102, 241, 0.025); filter: blur(100px); border-radius: 50%; pointer-events: none;
    }
    .decor-blur-soft-2 {
        position: absolute; bottom: -5%; right: -5%; width: 400px; height: 400px;
        background: rgba(124, 58, 237, 0.025); filter: blur(100px); border-radius: 50%; pointer-events: none;
    }

    /* Custom Modern Breadcrumb Framework */
    .custom-modern-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        content: "\e930" !important;
        font-family: 'feather' !important;
        font-size: 11px;
        color: var(--slate-300);
        vertical-align: middle;
    }
    .hover-primary { transition: color 0.2s ease; text-decoration: none; }
    .hover-primary:hover { color: var(--primary-color) !important; }

    /* Empty State Visual Frame */
    .empty-state-icon-soft {
        width: 64px; height: 64px; background-color: #f8fafc;
        border: 1px solid var(--slate-100);
    }

    /* ==========================================================================
       Custom Dynamic Content Typography (Safe For All Rich-Text Elements)
       ========================================================================== */
    .page-dynamic-typography {
        font-size: 1.05rem !important;
        line-height: 1.85 !important;
        color: var(--slate-700) !important;
    }
    .page-dynamic-typography p {
        margin-bottom: 1.5rem !important;
    }
    .page-dynamic-typography h2, 
    .page-dynamic-typography h3, 
    .page-dynamic-typography h4 {
        color: var(--slate-900) !important;
        font-weight: 700;
        margin-top: 2.5rem !important;
        margin-bottom: 1rem !important;
        line-height: 1.3;
    }
    .page-dynamic-typography h2 { font-size: 1.65rem; }
    .page-dynamic-typography h3 { font-size: 1.4rem; }
    
    /* Automated Responsive Tables & Rich Images inside Text Editor */
    .page-dynamic-typography img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 14px;
        margin: 1.5rem 0;
    }
    .page-dynamic-typography table {
        width: 100% !important;
        max-width: 100%;
        margin-bottom: 1.5rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    .page-dynamic-typography table th,
    .page-dynamic-typography table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid var(--slate-100);
        font-size: 0.95rem;
    }

    /* Fluid Responsive Device Screen Sync overrides */
    @media (max-width: 991.98px) {
        .py-md-6 { padding-top: 3rem; padding-bottom: 3rem; }
        .display-5 { font-size: 2.2rem !important; }
    }
    
    @media (max-width: 576px) {
        .display-5 { font-size: 1.65rem !important; }
        .card-body.p-4 { padding: 1.25rem !important; }
        .page-dynamic-typography { font-size: 0.98rem !important; line-height: 1.75 !important; }
        .custom-modern-breadcrumb { font-size: 12px; padding: 6px 14px !important; }
        .page-title-header { margin-bottom: 2rem !important; }
    }
</style>
@endsection