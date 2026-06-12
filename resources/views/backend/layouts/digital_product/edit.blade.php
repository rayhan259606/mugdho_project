@extends('backend.app', ['title' => 'Edit Digital Item'])

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Digital Products Item</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard") }}"><i class="fe fe-home me-2 fs-14"></i>Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route($route . '.index') }}">Digital Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card post-sales-main">
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Edit Item</h3>
                            <a href="{{ route($route . '.index') }}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route($route . '.update', $item->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label fw-bold">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter here title" id="title" value="{{ $item->title ?? '' }}" required>
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="price" class="form-label fw-bold">Price (৳):</label>
                                            <input type="number" step="1" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Enter price" id="price" value="{{ $item->price ?? '' }}" required>
                                            @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label for="discount" class="form-label fw-bold">Discount (৳):</label>
                                            <input type="number" step="1" class="form-control @error('discount') is-invalid @enderror" name="discount" placeholder="Enter discount" id="discount" value="{{ $item->discount ?? '0' }}">
                                            @error('discount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label fw-bold">Description:</label>
                                            <textarea class="summernote form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter here description" rows="5" required>{{ $item->description ?? '' }}</textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="position" class="form-label fw-bold">Position (for sorting):</label>
                                            <input type="number" class="form-control @error('position') is-invalid @enderror" name="position" placeholder="e.g. 1, 2, 3" id="position" value="{{ $item->position ?? '0' }}">
                                            @error('position')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label fw-bold">Product Image:</label>
                                            <input type="file" class="dropify" name="image" id="image" data-default-file="{{ $item->thumbnail ? asset($item->thumbnail) : '' }}" />
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4 text-end">
                                    <button class="submit btn btn-primary px-5" type="submit">Update</button>
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
