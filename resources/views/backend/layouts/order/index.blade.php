@extends('backend.app')

@section('title', 'Orders')

@section('content')
<div class="main-container container-fluid">
    <div class="page-header">
        <h1 class="page-title">Orders</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">All Customer Orders</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered text-nowrap border-bottom">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Address</th>
                                    <th>Total</th>
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
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.order.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'product', name: 'product'},
                {data: 'customer', name: 'customer'},
                {data: 'address', name: 'address'},
                {data: 'total', name: 'total'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    function showStatusChangeAlert(id) {
        Swal.fire({
            title: 'Change order status?',
            text: "This will toggle between Accept/Reject (or Pending).",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                statusChange(id);
            }
        });
    }

    function statusChange(id) {
        var url = "{{ route('admin.order.status', ':id') }}";
        $.ajax({
            url: url.replace(':id', id),
            type: 'GET',
            success: function(response) {
                if (response.status === 't-success') {
                    $('#datatable').DataTable().ajax.reload();
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    }

    function showDeleteConfirm(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This order will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteOrder(id);
            }
        });
    }

    function deleteOrder(id) {
        // Note: Order destroy route might not exist in the controller yet, let's check
        toastr.info("Delete functionality coming soon or not implemented in controller.");
    }
</script>
@endpush