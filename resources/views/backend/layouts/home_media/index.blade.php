@extends('backend.app', ['title' => 'Home Media'])

@push('styles')
<link href="{{ asset('default/datatable.css') }}" rel="stylesheet" />  
@endpush

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Home Media</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard") }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home Media</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <div class="card-options ms-auto">
                                <a href="{{ route('admin.home_media.create') }}" class="btn btn-primary btn-sm">Add Media</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-nowrap border-bottom" id="datatable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Media File</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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
        $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.home_media.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'type', name: 'type', className: 'text-center'},
                {data: 'title', name: 'title'},
                {data: 'file_path', name: 'file_path', orderable: false, searchable: false},
                {data: 'status', name: 'status', className: 'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
            ]
        });
    });

    function showStatusChangeAlert(id) {
        Swal.fire({
            title: 'Change status?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => { if (result.isConfirmed) statusChange(id); });
    }

    function statusChange(id) {
        $.get("{{ route('admin.home_media.status', ':id') }}".replace(':id', id), function(resp) {
            toastr.success(resp.message);
            $('#datatable').DataTable().ajax.reload();
        });
    }

    function showDeleteConfirm(id) {
        Swal.fire({
            title: 'Delete this media?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => { if (result.isConfirmed) deleteItem(id); });
    }

    function deleteItem(id) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('admin.home_media.destroy', ':id') }}".replace(':id', id),
            success: function(resp) {
                toastr.success(resp.message);
                $('#datatable').DataTable().ajax.reload();
            }
        });
    }

    function goToEdit(id) {
        window.location.href = "{{ route('admin.home_media.edit', ':id') }}".replace(':id', id);
    }
</script>
@endpush
