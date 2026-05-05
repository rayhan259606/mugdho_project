@extends('frontend.simple.app', ['title' => $post->title])

@section('content')
<section class="py-6 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->title, 20) }}</li>
                    </ol>
                </nav>

                <img src="{{ asset($post->thumbnail) }}" class="img-fluid rounded-32 shadow-lg mb-5 w-100" style="max-height: 500px; object-fit: cover;" alt="{{ $post->title }}">
                
                <div class="post-header mb-5">
                    <h1 class="display-4 fw-bold text-slate-900 mb-3">{{ $post->title }}</h1>
                    <div class="d-flex align-items-center text-slate-500">
                        <span class="me-4"><i class="fe fe-calendar me-2"></i> {{ $post->created_at->format('M d, Y') }}</span>
                        <span><i class="fe fe-user me-2"></i> Admin</span>
                    </div>
                </div>

                <div class="post-content fs-5 text-slate-700 mb-6" style="line-height: 1.8;">
                    {!! $post->description !!}
                </div>

                <!-- SHARE SECTION -->
                <div class="share-box p-4 bg-slate-50 rounded-24 d-flex align-items-center justify-content-between mb-6">
                    <h5 class="fw-bold text-slate-800 mb-0">Share this post:</h5>
                    <div class="d-flex">
                        <a href="#" class="btn btn-navy-soft btn-icon rounded-circle me-2"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="btn btn-navy-soft btn-icon rounded-circle me-2"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="btn btn-navy-soft btn-icon rounded-circle"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .rounded-32 { border-radius: 32px !important; }
    .rounded-24 { border-radius: 24px !important; }
    .post-content p { margin-bottom: 1.5rem; }
    .btn-icon { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; }
</style>
@endsection
