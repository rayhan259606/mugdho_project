@extends('backend.app')

@section('title', 'Edit Banner')

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">Edit Banner</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}">Banner</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Modify Banner #{{ $banner->id }}</h3>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group mb-4">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $banner->title) }}" placeholder="Banner Title">
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" placeholder="Banner Subtitle">
                                    @error('subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Link (Optional)</label>
                                    <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link', $banner->link) }}" placeholder="https://example.com">
                                    @error('link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Current Image</label>
                                    <div class="mb-3">
                                        <img src="{{ asset($banner->image) }}" alt="Banner" class="img-thumbnail" style="max-width: 300px; border-radius: 8px;">
                                    </div>
                                    <label class="form-label">Change Image (Optional)</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary px-5">Update Banner</button>
                                    <a href="{{ route('admin.banner.index') }}" class="btn btn-danger px-5">Cancel</a>
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
