@extends('backend.app')

@section('title', 'Edit Home Media')

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">Edit Home Media</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home_media.index') }}">Home Media</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Edit Poster or Video</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.home_media.update', $media->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="form-label">Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror" name="type" id="mediaType" required>
                                        <option value="poster" {{ old('type', $media->type) === 'poster' ? 'selected' : '' }}>Poster (Image)</option>
                                        <option value="video" {{ old('type', $media->type) === 'video' ? 'selected' : '' }}>Video</option>
                                    </select>
                                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $media->title) }}" placeholder="Enter Title">
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Link (Optional)</label>
                                    <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link', $media->link) }}" placeholder="https://example.com">
                                    @error('link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label" id="fileLabel">Upload File (Leave empty to keep current)</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="fileInput">
                                    <small class="form-text text-muted" id="fileHelp">For Poster, upload an image file. For Video, upload a video file.</small>
                                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Current Media</label>
                                    <div class="mt-2 border p-3 rounded" style="background: #f8fafc; max-width: 320px;">
                                        @if($media->type === 'poster')
                                            <img src="{{ asset($media->file_path) }}" alt="Current Poster" class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: contain;">
                                        @else
                                            <video class="w-100 rounded shadow-sm" controls style="max-height: 200px;">
                                                <source src="{{ asset($media->file_path) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary px-5">Update Media</button>
                                    <a href="{{ route('admin.home_media.index') }}" class="btn btn-danger px-5">Cancel</a>
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
<script>
    $(document).ready(function() {
        function updateFileHelp() {
            var selectedType = $('#mediaType').val();
            if (selectedType === 'poster') {
                $('#fileLabel').html('Upload Image (Leave empty to keep current)');
                $('#fileHelp').text('For Poster, upload an image file (jpg, jpeg, png, svg, gif). Max 10MB.');
                $('#fileInput').attr('accept', 'image/*');
            } else {
                $('#fileLabel').html('Upload Video (Leave empty to keep current)');
                $('#fileHelp').text('For Video, upload a video file (mp4, webm, ogg, mov, qt). Max 50MB.');
                $('#fileInput').attr('accept', 'video/*');
            }
        }

        $('#mediaType').change(updateFileHelp);
        updateFileHelp(); // Initial trigger
    });
</script>
@endpush
