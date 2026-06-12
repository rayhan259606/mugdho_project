@extends('backend.app', ['title' => 'Enrollments'])

@push('styles')
<link href="{{ asset('default/datatable.css') }}" rel="stylesheet" />  
@endpush

@section('content')
<div class="app-content main-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">Course Enrollments</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                             <table class="table table-bordered text-nowrap border-bottom" id="datatable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Course</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Payment Method</th>
                                        <th>Paid To</th>
                                        <th>Transaction ID</th>
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
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.lead.enrollments') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'course', name: 'course'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'payment_method', name: 'payment_method'},
                {data: 'paid_to', name: 'paid_to'},
                {data: 'transaction_id', name: 'transaction_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    function showDeleteConfirm(id, type) {
        Swal.fire({
            title: 'Delete this record?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => { if (result.isConfirmed) deleteItem(id, type); });
    }

    function deleteItem(id, type) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/lead/enrollment/delete') }}/" + id,
            headers: { "X-CSRF-TOKEN": '{{ csrf_token() }}' },
            success: function(resp) {
                toastr.success(resp.message);
                $('#datatable').DataTable().ajax.reload();
            }
        });
    }
</script>
@endpush
