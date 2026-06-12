@extends('backend.app', ['title' => 'Order Details'])

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">

            <div class="page-header">
                <div>
                    <h1 class="page-title">Order Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="fe fe-home me-2 fs-14"></i>Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">
                                <i class="fe fe-shopping-bag me-2"></i>Order #{{ $order->uid ?? 'N/A' }}
                            </h3>
                            <div class="d-flex gap-2 align-items-center">
                                @php
                                    $statusClass = $order->status === 'accepted' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary');
                                @endphp
                                <span class="badge bg-{{ $statusClass }} px-3 py-2 fs-13">{{ ucfirst($order->status ?? 'N/A') }}</span>
                                <a href="javascript:window.history.back()" class="btn btn-sm btn-primary">
                                    <i class="fe fe-arrow-left me-1"></i> Back
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            {{-- Product Info --}}
                            <h5 class="fw-semibold text-muted text-uppercase fs-12 mb-3 border-bottom pb-2">
                                <i class="fe fe-box me-1"></i> Product Information
                            </h5>
                            <table class="table table-bordered table-striped mb-4">
                                <tr>
                                    <th width="35%">Product</th>
                                    <td>
                                        @if($order->product_id && $order->product)
                                            {{ $order->product->title }} <span class="badge bg-secondary ms-1">General</span>
                                        @elseif($order->antique_product_id && $order->antiqueProduct)
                                            {{ $order->antiqueProduct->title }} <span class="badge bg-warning text-dark ms-1">Antique</span>
                                        @elseif($order->digital_product_id && $order->digitalProduct)
                                            {{ $order->digitalProduct->title }} <span class="badge bg-info ms-1">Digital</span>
                                        @elseif($order->gadget_id && $order->gadget)
                                            {{ $order->gadget->title }} <span class="badge bg-success ms-1">Gadget</span>
                                        @else
                                            <span class="text-danger">Product Deleted</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td><strong>৳{{ number_format($order->price ?? 0, 2) }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Shipping Charge</th>
                                    <td>৳{{ number_format($order->shipping_charge ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td><strong class="text-primary fs-15">৳{{ number_format(($order->price ?? 0) + ($order->shipping_charge ?? 0), 2) }}</strong></td>
                                </tr>
                            </table>

                            {{-- Customer Info --}}
                            <h5 class="fw-semibold text-muted text-uppercase fs-12 mb-3 border-bottom pb-2">
                                <i class="fe fe-user me-1"></i> Customer Information
                            </h5>
                            <table class="table table-bordered table-striped mb-4">
                                <tr>
                                    <th width="35%">Name</th>
                                    <td>{{ $order->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $order->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $order->phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Shipping Address</th>
                                    <td>{{ $order->address ?? 'N/A' }}</td>
                                </tr>
                            </table>

                            {{-- Payment Info --}}
                            <h5 class="fw-semibold text-muted text-uppercase fs-12 mb-3 border-bottom pb-2">
                                <i class="fe fe-credit-card me-1"></i> Payment Information
                            </h5>
                            <table class="table table-bordered table-striped mb-4">
                                <tr>
                                    <th width="35%">Payment Method</th>
                                    <td>
                                        @if($order->payment_method === 'bkash')
                                            <span class="badge bg-danger px-3">bKash</span>
                                        @elseif($order->payment_method === 'nagad')
                                            <span class="badge bg-warning text-dark px-3">Nagad</span>
                                        @else
                                            <span class="badge bg-secondary px-3">Cash on Delivery</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Paid To (Number)</th>
                                    <td>
                                        @if($order->paid_to)
                                            <strong>{{ $order->paid_to }}</strong>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Transaction ID</th>
                                    <td>
                                        @if($order->transaction_id)
                                            <code class="fs-14 text-success bg-light px-2 py-1 rounded">{{ $order->transaction_id }}</code>
                                        @else
                                            <span class="text-muted">— Not Provided</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            {{-- Meta Info --}}
                            <h5 class="fw-semibold text-muted text-uppercase fs-12 mb-3 border-bottom pb-2">
                                <i class="fe fe-clock me-1"></i> Order Meta
                            </h5>
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th width="35%">Order UID</th>
                                    <td><code>{{ $order->uid ?? 'N/A' }}</code></td>
                                </tr>
                                <tr>
                                    <th>Order Status</th>
                                    <td><span class="badge bg-{{ $statusClass }}">{{ ucfirst($order->status ?? 'N/A') }}</span></td>
                                </tr>
                                <tr>
                                    <th>Placed At</th>
                                    <td>{{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $order->updated_at ? $order->updated_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                </tr>
                            </table>

                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">
                                <i class="fe fe-arrow-left me-1"></i> All Orders
                            </a>
                            <button class="btn btn-danger" onclick="showDeleteConfirm({{ $order->id }})">
                                <i class="fe fe-trash me-1"></i> Delete Order
                            </button>
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
    function showDeleteConfirm(id) {
        Swal.fire({
            title: 'Delete this order?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                let url = "{{ route('admin.order.destroy', ':id') }}";
                let csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    type: "DELETE",
                    url: url.replace(':id', id),
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    success: function(resp) {
                        if (resp.status === 't-success') {
                            toastr.success(resp.message);
                            window.location.href = "{{ route('admin.order.index') }}";
                        } else {
                            toastr.error(resp.message);
                        }
                    },
                    error: function() {
                        toastr.error('Something went wrong.');
                    }
                });
            }
        });
    }
</script>
@endpush