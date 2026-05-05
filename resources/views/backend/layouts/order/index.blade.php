@extends('backend.app')

@section('title', 'Orders')

@section('content')
<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">
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

    <!-- ROW-1 -->
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="card bg-primary img-card box-primary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $totalOrders ?? 0 }}</h2>
                            <p class="text-white mb-0">Total Orders</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-shopping-cart text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="card bg-warning img-card box-secondary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $pendingOrders ?? 0 }}</h2>
                            <p class="text-white mb-0">Pending Orders</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-clock text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="card bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $completedOrders ?? 0 }}</h2>
                            <p class="text-white mb-0">Completed Orders</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-check-circle text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="card bg-info img-card box-info-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">৳{{ number_format($totalRevenue ?? 0, 2) }}</h2>
                            <p class="text-white mb-0">Total Revenue</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-dollar-sign text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- ROW-1 END -->

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
</div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.order.index') }}",
            dom: "<'row justify-content-between table-topbar'<'col-md-4 col-sm-3'l><'col-md-8 col-sm-9 d-flex justify-content-end px-0'Bf>>tipr",
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
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
        event.preventDefault();
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
        let url = "{{ route('admin.order.destroy', ':id') }}";
        let csrfToken = '{{ csrf_token() }}';
        $.ajax({
            type: "DELETE",
            url: url.replace(':id', id),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(resp) {
                if (resp.status === 't-success') {
                    toastr.success(resp.message);
                    $('#datatable').DataTable().ajax.reload();
                } else {
                    toastr.error(resp.message);
                }
            },
            error: function(error) {
                toastr.error('Something went wrong.');
            }
        });
    }
</script>
@endpush