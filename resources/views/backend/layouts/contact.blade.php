@extends('backend.app', ['title' => 'Contact'])

@push('styles')
<link href="{{ asset('default/datatable.css') }}" rel="stylesheet" />  
@endpush


@section('content')
<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">


            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">{{ $crud ? ucwords(str_replace('_', ' ', $crud)) : 'N/A' }}</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard") }}"><i class="fe fe-home me-2 fs-14"></i>Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contact</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-4 -->
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card product-sales-main">
                        <div class="card-header border-bottom">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger"><a href="#">Import</a></button>
                                <button type="button" class="btn btn-warning"><a href="#">Export</a></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table class="table table-bordered text-nowrap border-bottom" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="bg-transparent border-bottom-0">ID</th>
                                            <th class="bg-transparent border-bottom-0">Name</th>
                                            <th class="bg-transparent border-bottom-0">Email / Phone</th>
                                            <th class="bg-transparent border-bottom-0">Subject</th>
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
                </div><!-- COL END -->
            </div>
            <!-- ROW-4 END -->

        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection



@push('scripts')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });
        if (!$.fn.DataTable.isDataTable('#datatable')) {
            let dTable = $('#datatable').DataTable({
                order: [],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                processing: true,
                responsive: true,
                serverSide: true,

                language: {
                    processing: `<div class="text-center">
                        <img src="{{ asset('default/loader.gif') }}" alt="Loader" style="width: 50px;">
                        </div>`
                },

                scroller: {
                    loadingIndicator: false
                },
                pagingType: "full_numbers",
                dom: "<'row justify-content-between table-topbar'<'col-md-4 col-sm-3'l><'col-md-5 col-sm-5 px-0'f>>tipr",
                ajax: {
                    url: "{{ route('admin.contact.index') }}",
                    type: "GET",
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'subject',
                        name: 'subject',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'dt-center text-center'
                    },
                ],
            });
        }
    });

    // Status Change Confirm Alert
    function showStatusChangeAlert(id) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update the status?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                statusChange(id);
            }
        });
    }

    // Status Change
    function statusChange(id) {
        NProgress.start();
        let url = "{{ route('admin.contact.status', ':id') }}";
        $.ajax({
            type: "GET",
            url: url.replace(':id', id),
            success: function(resp) {
                NProgress.done();
                toastr.success(resp.message);
                $('#datatable').DataTable().ajax.reload();
            },
            error: function(error) {
                NProgress.done();
                toastr.error(error.message);
            }
        });
    }

    // View Details Modal Trigger Function
    function viewContactDetails(button) {
        let name = $(button).attr('data-name');
        let email = $(button).attr('data-email');
        let subject = $(button).attr('data-subject');
        let message = $(button).attr('data-message');

        $('#modalName').text(name);
        $('#modalEmail').text(email);
        $('#modalSubject').text(subject);
        $('#modalMessage').html(message.replace(/\n/g, '<br>'));

        let myModal = new bootstrap.Modal(document.getElementById('contactDetailsModal'));
        myModal.show();
    }
</script>

<!-- View Contact Details Modal -->
<div class="modal fade" id="contactDetailsModal" tabindex="-1" aria-labelledby="contactDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-16 shadow-lg">
            <div class="modal-header bg-primary text-white border-0 py-3 rounded-top-16">
                <h5 class="modal-title fw-bold" id="contactDetailsModalLabel">
                    <i class="fe fe-mail me-2"></i> Inquiry Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="card border-0 shadow-sm rounded-12 p-4">
                    <div class="row g-4">
                        <div class="col-md-6 border-bottom pb-3">
                            <span class="text-secondary small d-block mb-1">Sender Name</span>
                            <span id="modalName" class="fw-bold text-dark fs-16">N/A</span>
                        </div>
                        <div class="col-md-6 border-bottom pb-3">
                            <span class="text-secondary small d-block mb-1">Email / Phone</span>
                            <span id="modalEmail" class="fw-bold text-dark fs-16">N/A</span>
                        </div>
                        <div class="col-12 border-bottom pb-3">
                            <span class="text-secondary small d-block mb-1">Subject</span>
                            <span id="modalSubject" class="fw-semibold text-slate-800 fs-15">N/A</span>
                        </div>
                        <div class="col-12">
                            <span class="text-secondary small d-block mb-1">Message Description</span>
                            <div id="modalMessage" class="p-3 rounded bg-light border text-slate-700 fs-14" style="white-space: pre-wrap; line-height: 1.6; max-height: 250px; overflow-y: auto;">
                                N/A
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light py-3 rounded-bottom-16">
                <button type="button" class="btn btn-secondary rounded-8 px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-16 { border-radius: 16px !important; }
    .rounded-12 { border-radius: 12px !important; }
    .rounded-top-16 { border-top-left-radius: 16px !important; border-top-right-radius: 16px !important; }
    .rounded-bottom-16 { border-bottom-left-radius: 16px !important; border-bottom-right-radius: 16px !important; }
    .rounded-8 { border-radius: 8px !important; }
    .fs-15 { font-size: 15px; }
    .fs-16 { font-size: 16px; }
    .text-slate-800 { color: #1e293b; }
    .text-slate-700 { color: #334155; }
</style>
@endpush