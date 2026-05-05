@extends('backend.app')

@section('title', 'Service Requests')

@section('content')
<div class="main-container container-fluid">
    <div class="page-header">
        <h1 class="page-title">Service Requests</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Lead Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Service Requests</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Service Requests</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bordered text-nowrap key-buttons border-bottom">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">SL</th>
                                    <th class="border-bottom-0">Service</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Phone</th>
                                    <th class="border-bottom-0">Address</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Action</th>
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
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.lead.service-requests') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'service', name: 'service'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'address', name: 'address'},
                {data: 'created_at', name: 'created_at', render: function(data) {
                    return new Date(data).toLocaleDateString();
                }},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    function showDeleteConfirm(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteServiceRequest(id);
            }
        });
    }

    function deleteServiceRequest(id) {
        var url = "{{ route('admin.lead.service-requests.destroy', ':id') }}";
        url = url.replace(':id', id);
        
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 't-success') {
                    $('#data-table').DataTable().ajax.reload();
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    }
</script>
@endpush
