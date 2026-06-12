@extends('backend.app', ['title' => 'Manage Gadgets'])

@push('styles')
<link href="{{ asset('default/datatable.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Gadgets Module</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard") }}"><i class="fe fe-home me-2 fs-14"></i>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gadgets</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW -->
            <div class="row">
                <!-- CMS HERO SETTINGS -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Page Hero Content</h3>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route($route . '.cms.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12">
                                        <x-form.text name="title" label="Hero Title" placeholder="Enter page title" :value="$cms?->title ?? ''" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <x-form.textarea name="description" label="Hero Description" placeholder="Enter page description" :value="$cms?->description ?? ''" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <x-form.text name="feature_1_title" label="Feature 1 Title" placeholder="e.g. Quality Guaranteed & Handpicked" :value="$cms?->metadata['feature_1_title'] ?? ''" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <x-form.text name="feature_2_title" label="Feature 2 Title" placeholder="e.g. Fast & Secure Worldwide Shipping" :value="$cms?->metadata['feature_2_title'] ?? ''" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <x-form.file name="image" label="Hero Banner / Image" :file="$cms?->image ?? ''">
                                            <p class="textTransform">Allowed types: jpeg, png, jpg, gif, svg, webp. Max 5MB.</p>
                                        </x-form.file>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <button class="submit btn btn-primary w-100" type="submit">Update Page Content</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- PRODUCTS LIST -->
                <div class="col-md-7">
                    <div class="card product-sales-main">
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Products / Items</h3>
                            <a href="{{ route($route . '.create') }}" class="btn btn-primary btn-sm">Add New Item</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="bg-transparent border-bottom-0 wp-15">SL</th>
                                            <th class="bg-transparent border-bottom-0 wp-15">Title</th>
                                            <th class="bg-transparent border-bottom-0">Image</th>
                                            <th class="bg-transparent border-bottom-0">Status</th>
                                            <th class="bg-transparent border-bottom-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW END -->

        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('backend.layouts.'.$part.'._script')
@endpush
