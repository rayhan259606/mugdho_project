@extends('frontend.simple.app', ['title' => 'Blog'])

@section('content')
<section class="py-6 bg-slate-50">
    <div class="container">
        <div class="text-center mb-6">
            <h6 class="text-primary text-uppercase fw-bold ls-2 mb-3">Our Blog</h6>
            <h2 class="display-5 fw-bold text-slate-900">Latest News & Insights</h2>
            <div class="title-line mx-auto mt-3"></div>
        </div>

        <div class="row g-4">
            @forelse($posts as $post)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-24 overflow-hidden post-card">
                    <div class="position-relative">
                        <img src="{{ asset($post->thumbnail) }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="{{ $post->title }}">
                        <div class="post-date bg-primary text-white p-2 rounded-12 position-absolute" style="top: 15px; left: 15px;">
                            <span class="fw-bold">{{ $post->created_at->format('d') }}</span><br>
                            <small>{{ $post->created_at->format('M') }}</small>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-slate-800 mb-3">{{ $post->title }}</h4>
                        <p class="text-slate-500 mb-4">{{ Str::limit(strip_tags($post->description), 120) }}</p>
                        <a href="{{ route('post.show', $post->slug) }}" class="btn btn-navy-soft rounded-pill px-4 fw-bold">Read More <i class="fe fe-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-6">
                <i class="fe fe-edit-3 display-1 text-slate-200 mb-4"></i>
                <h3 class="text-slate-800 fw-bold">No posts available yet</h3>
                <a href="{{ route('home') }}" class="btn btn-primary rounded-pill mt-3">Back to Home</a>
            </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .post-card { transition: all 0.3s ease; }
    .post-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important; }
    .post-date { text-align: center; line-height: 1; min-width: 50px; }
    .rounded-24 { border-radius: 24px !important; }
    .rounded-12 { border-radius: 12px !important; }
</style>
@endsection
