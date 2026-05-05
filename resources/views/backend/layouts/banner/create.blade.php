@extends('backend.app')

@section('title', 'Create Banner')

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">Create Banner</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}">Banner</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Add New Banner</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Banner Title">
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle') }}" placeholder="Banner Subtitle">
                                    @error('subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Link (Optional)</label>
                                    <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" placeholder="https://example.com">
                                    @error('link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Banner Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
                                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary px-5">Save Banner</button>
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
