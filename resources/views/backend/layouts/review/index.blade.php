@extends('backend.app', ['title' => 'Manage Reviews'])

@push('styles')
<link href="{{ asset('default/datatable.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">Manage Product Reviews</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Product</th>
                                            <th>User</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
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
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.review.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'product', name: 'product'},
                {data: 'user', name: 'user'},
                {data: 'rating', name: 'rating'},
                {data: 'review', name: 'review'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    function toggleStatus(id) {
        $.ajax({
            type: "GET",
            url: "{{ url('admin/review/status') }}/" + id,
            success: function(resp) {
                toastr.success(resp.message);
                $('#datatable').DataTable().ajax.reload();
            }
        });
    }

    function showDeleteConfirm(id) {
        Swal.fire({
            title: 'Delete this review?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/review/delete') }}/" + id,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function(resp) {
                        toastr.success(resp.message);
                        $('#datatable').DataTable().ajax.reload();
                    }
                });
            }
        });
    }
</script>
@endpush
