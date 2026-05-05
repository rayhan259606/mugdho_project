@extends('backend.app', ['title' => 'Edit Page'])

@section('content')

<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Page</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard") }}"><i class="fe fe-home me-2 fs-14"></i>Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">Page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-0">Update: {{ $page->name }}</h3>
                            <div class="card-options">
                                <a href="{{ route('admin.page.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Page Name:</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $page->name) }}" placeholder="e.g. Privacy Policy">
                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Display Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $page->title) }}" placeholder="e.g. Privacy Policy & Usage Terms">
                                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Content:</label>
                                            <textarea class="form-control @error('content') is-invalid @enderror description" name="content" id="description" rows="10">{{ old('content', $page->content) }}</textarea>
                                            @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Icon (Optional):</label>
                                            <input type="file" class="dropify" name="icon" data-height="100" data-default-file="{{ $page->icon ? asset($page->icon) : '' }}">
                                            @error('icon')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <hr>
                                        <h4 class="fw-bold">SEO Settings</h4>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Meta Title:</label>
                                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" placeholder="SEO Title">
                                            @error('meta_title')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Meta Description:</label>
                                            <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                                            @error('meta_description')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Meta Keywords:</label>
                                            <textarea class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" rows="3" placeholder="Comma separated keywords">{{ old('meta_keywords', $page->meta_keywords) }}</textarea>
                                            @error('meta_keywords')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Meta Image:</label>
                                            <input type="file" class="dropify" name="meta_image" data-height="100" data-default-file="{{ $page->meta_image ? asset($page->meta_image) : '' }}">
                                            @error('meta_image')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button class="btn btn-primary px-5 py-2 fw-bold" type="submit">Update Page</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
        CKEDITOR.replace('description');
    });
</script>
@endpush