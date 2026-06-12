@extends('backend.app', ['title' => 'General Settings'])

@section('content')
<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            {{-- PAGE-HEADER --}}
            <div class="page-header">
                <div>
                    <h1 class="page-title">{{ $crud ? ucwords(str_replace('_', ' ', $crud)) : 'N/A' }}</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard") }}"><i class="fe fe-home me-2 fs-14"></i>Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">General</li>
                    </ol>
                </div>
            </div>
            {{-- PAGE-HEADER --}}


            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card box-shadow-0">
                        <div class="card-header border-bottom">
                            <h3 class="card-title mb-0">Show</h3>
                            <div class="card-options">
                                <a href="javascript:window.history.back()" class="btn btn-sm btn-primary">Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="post" action="{{ route('admin.setting.general.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="row mb-4">

                                    <div class="form-group">
                                        <label for="username" class="form-label">Name:</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Name" id="username"
                                            value="{{ $setting->name ?? old('name') ?? '' }}">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="form-label">Title:</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" placeholder="Title" id="title"
                                            value="{{ $setting->title ?? old('title') ?? '' }}">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            name="description" placeholder="Description" id="description">{{ $setting->description ?? old('description') ?? '' }}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="keywords" class="form-label">Keywords:</label>
                                        <textarea class="form-control @error('keywords') is-invalid @enderror"
                                            name="keywords" placeholder="Keywords" id="keywords">{{ $setting->keywords ?? old('keywords') ?? '' }}</textarea>
                                        @error('keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="author" class="form-label">Author:</label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                                            name="author" placeholder="Author" id="author"
                                            value="{{ $setting->author ?? old('author') ?? '' }}">
                                        @error('author')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone:</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" placeholder="Phone" id="phone"
                                            value="{{ $setting->phone ?? old('phone') ?? '' }}">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="Email" id="email"
                                            value="{{ $setting->email ?? old('email') ?? '' }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="form-label">Address:</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            name="address" placeholder="Address" id="address"
                                            value="{{ $setting->address ?? old('address') ?? '' }}">
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="copyright" class="form-label">Copyright:</label>
                                        <input type="text" class="form-control @error('copyright') is-invalid @enderror"
                                            name="copyright" placeholder="Copyright" id="copyright"
                                            value="{{ $setting->copyright ?? old('copyright') ?? '' }}">
                                        @error('copyright')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card border mt-4 mb-4">
                                        <div class="card-header bg-light">
                                            <h4 class="card-title mb-0">WhatsApp Settings</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="whatsapp_number_1" class="form-label">WhatsApp Number 1:</label>
                                                    <input type="text" class="form-control @error('whatsapp_number_1') is-invalid @enderror"
                                                        name="whatsapp_number_1" placeholder="e.g. 8801700000000" id="whatsapp_number_1"
                                                        value="{{ $setting->whatsapp_number_1 ?? old('whatsapp_number_1') ?? '' }}">
                                                    @error('whatsapp_number_1')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="whatsapp_number_2" class="form-label">WhatsApp Number 2:</label>
                                                    <input type="text" class="form-control @error('whatsapp_number_2') is-invalid @enderror"
                                                        name="whatsapp_number_2" placeholder="e.g. 8801700000000" id="whatsapp_number_2"
                                                        value="{{ $setting->whatsapp_number_2 ?? old('whatsapp_number_2') ?? '' }}">
                                                    @error('whatsapp_number_2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="whatsapp_number_3" class="form-label">WhatsApp Number 3:</label>
                                                    <input type="text" class="form-control @error('whatsapp_number_3') is-invalid @enderror"
                                                        name="whatsapp_number_3" placeholder="e.g. 8801700000000" id="whatsapp_number_3"
                                                        value="{{ $setting->whatsapp_number_3 ?? old('whatsapp_number_3') ?? '' }}">
                                                    @error('whatsapp_number_3')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="whatsapp_number_4" class="form-label">WhatsApp Number 4:</label>
                                                    <input type="text" class="form-control @error('whatsapp_number_4') is-invalid @enderror"
                                                        name="whatsapp_number_4" placeholder="e.g. 8801700000000" id="whatsapp_number_4"
                                                        value="{{ $setting->whatsapp_number_4 ?? old('whatsapp_number_4') ?? '' }}">
                                                    @error('whatsapp_number_4')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card border mt-4 mb-4">
                                        <div class="card-header bg-light">
                                            <h4 class="card-title mb-0">Payment Settings</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="bkash_number" class="form-label">bKash Personal Number:</label>
                                                    <input type="text" class="form-control @error('bkash_number') is-invalid @enderror"
                                                        name="bkash_number" placeholder="e.g. 01700000000" id="bkash_number"
                                                        value="{{ $setting->bkash_number ?? old('bkash_number') ?? '' }}">
                                                    @error('bkash_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="nagad_number" class="form-label">Nagad Personal Number:</label>
                                                    <input type="text" class="form-control @error('nagad_number') is-invalid @enderror"
                                                        name="nagad_number" placeholder="e.g. 01700000000" id="nagad_number"
                                                        value="{{ $setting->nagad_number ?? old('nagad_number') ?? '' }}">
                                                    @error('nagad_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="thumbnail" class="form-label">Thumbnail:</label>
                                                <input type="file" class="dropify form-control @error('thumbnail') is-invalid @enderror"
                                                    data-default-file="{{ !empty($setting->thumbnail) && file_exists(public_path($setting->thumbnail)) ? asset($setting->thumbnail) : asset('default/logo.png') }}"
                                                    name="thumbnail" id="thumbnail">
                                                    <p class="textTransform">Image Size Less than 5MB and Image Type must be jpeg,jpg,png.</p>
                                                @error('favicon')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="favicon" class="form-label">Favicon:</label>
                                                <input type="file" class="dropify form-control @error('favicon') is-invalid @enderror"
                                                    data-default-file="{{ !empty($setting->favicon) && file_exists(public_path($setting->favicon)) ? asset($setting->favicon) : asset('default/logo.png') }}"
                                                    name="favicon" id="favicon">
                                                    <p class="textTransform">Image Size Less than 5MB and Image Type must be jpeg,jpg,png.</p>
                                                @error('favicon')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="submit btn btn-primary" type="submit">Update</button>
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
<!-- CONTAINER CLOSED -->
@endsection



@push('scripts')
@endpush