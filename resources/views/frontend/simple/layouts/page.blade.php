@extends('frontend.simple.app', ['title' => $page->title ?? 'Page'])

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page->title ?? 'Page' }}</li>
                    </ol>
                </nav>
                
                <div class="card border-0 shadow-sm rounded-20 overflow-hidden">
                    <div class="card-body p-5 bg-white">
                        <h1 class="fw-bold mb-5 display-5 text-dark border-bottom pb-4">{{ $page->title ?? 'Untitled Page' }}</h1>
                        <div class="page-content lead text-muted" style="line-height: 1.8;">
                            @if($page && $page->content)
                                {!! $page->content !!}
                            @else
                                <p class="text-center py-5">Content for this page is currently unavailable.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .rounded-20 { border-radius: 20px !important; }
    .page-content p { margin-bottom: 1.5rem; }
    .page-content h2, .page-content h3 { 
        color: #1e293b; 
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }
    @media (max-width: 576px) {
        .display-5 { font-size: 1.8rem !important; }
        .card-body.p-5 { padding: 1.5rem !important; }
        .lead { font-size: 1rem !important; }
        .py-5 { padding-top: 2rem !important; padding-bottom: 2rem !important; }
    }
</style>
@endsection