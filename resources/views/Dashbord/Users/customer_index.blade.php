@extends('layouts.master')
@section('css')

@section('title')
المستخدمين
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('admins.home') }}</h4><span
                class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{ trans('admins.title') }}</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div class="main-body">
    <div id="error_message"></div>
    <div class="row row-sm">
    @can('customer-view')
<div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customers.export') }}" method="post">
                    @csrf
                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-3" id="fnWrapper">
                            <label>{{ trans('orders.custmer') }} :</label>
                            <input type="text" class="form-control form-control-md mg-b-20" name="custmer"
                                id="custmer">
                        </div>
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('orders.phone')}} :</label>
                            <input type="number" class="form-control form-control-md mg-b-20" name="phone"
                                id="phone">
                        </div>
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('orders.payment_status')}} :</label>
                            <select class="form-control form-control-md mg-b-20" id="payment_status" name="payment_status">
                                <option value="">{{ trans('orders.all') }}</option>
                                <option value="active">{{ trans('category.Active') }}</option>
                                <option value="inactive">{{ trans('category.iActive') }}</option>
                                <option value="pending_activation">{{ trans('app_users.pActive') }}</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Download</button>
                </form>
                <br>
                <button  class="btn btn-primary" id="s">{{ trans('orders.Sarech') }}</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="payment/update" method="post" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="patch">
                        <input type="hidden" name="_token" value="bho3ucwXV924HuADSjVR9WSKwpb5jvuIqz9ZzB4m">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <table class="table table-hover" style=" text-align: center;">
                                <thead>
                                <tr>
                                    <th>{{ trans('orders.title') }}</th>
                                    <th>{{ trans('orders.description') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <td id="idorder"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.custmer') }}</th>
                                    <td id="custmer12"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.phone') }}</th>
                                    <td id="phone12"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.whats') }}</th>
                                    <td id="custmer_whats"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        @can('customer-view')
                        <table class="table table-hover" id="get_admins" style=" text-align: center;">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ trans('orders.custmer') }}</th>
                                    <th class="wd-20p border-bottom-0">{{ trans('admins.phone') }}</th>
                                    <th class="border-bottom-0">{{ trans('orders.created_at') }}</th>
                                    <th class="border-bottom-0">{{ trans('ads.Status') }}</th>
                                    <th class="border-bottom-0">
                                        @canany([ 'customer-update' , 'customer-delete' ])
                                        {{ trans('admins.Processes') }}
                                        @endcanany
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
<script>
var local = "{{ App::getLocale() }}";
$('#s').click(function(e) {
    e.preventDefault();
    console.log('dsadsadsad');
    var custmer = $('#custmer').val();
    var phone = $('#phone').val();
    var payment_status = $('#payment_status').val();

    $('#get_admins').DataTable({
        bDestroy: true,
        processing: true,
        serverSide: true,
        searching: false,
        pageLength: 20,
        ajax: {
            url: '{{route("get_customers")}}/?custmer=' + custmer + '&phone=' + phone + '&payment_status=' + payment_status,
        },
        columns: [
        {
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                return data.first_name + " " + data.last_name;
            },
        },
        {
            'data': 'mobile_number',
            'className': 'text-center text-lg text-medium'
        },
        {
        'data': null,
        'className': 'text-center text-lg text-medium',
        render: function (data) {
            if (data == null) return "";
            var dateFormat = new Date(data.created_at);
            return dateFormat.getDate()+
           "/"+(dateFormat.getMonth()+1)+
           "/"+dateFormat.getFullYear();
            }
        },
        {
            'data': null,
            render: function(data, row, type) {
                var phone;
                if (data.status == 'active') {
                    return `<button class="btn btn-success-gradient btn-block" id="active" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.Active') }}</button>`;
                } else if (data.status == 'inactive') {
                    return `<button class="btn btn-danger-gradient btn-block" id="inactive" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.iActive') }}</button>`;
                } else {
                    return `<button class="btn btn-warning-gradient btn-block" id="pending_activation" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('app_users.pActive') }}</button>`;
                }
            },
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                @can('customer-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteAdmin" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan
                `;

            },
        },
    ],
    });
});
var table = $('#get_admins').DataTable({
    // processing: true,
    ajax: '{!! route("get_customers") !!}',
    columns: [
        {
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                return data.first_name + " " + data.last_name;
            },
        },
        {
            'data': 'mobile_number',
            'className': 'text-center text-lg text-medium'
        },
        {
        'data': null,
        'className': 'text-center text-lg text-medium',
        render: function (data) {
            if (data == null) return "";
            var dateFormat = new Date(data.created_at);
            return dateFormat.getDate()+
           "/"+(dateFormat.getMonth()+1)+
           "/"+dateFormat.getFullYear();
            }
        },
        {
            'data': null,
            render: function(data, row, type) {
                var phone;
                if (data.status == 'active') {
                    return `<button class="btn btn-success-gradient btn-block" id="active" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.Active') }}</button>`;
                } else if (data.status == 'inactive') {
                    return `<button class="btn btn-danger-gradient btn-block" id="inactive" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.iActive') }}</button>`;
                } else {
                    return `<button class="btn btn-warning-gradient btn-block" id="pending_activation" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('app_users.pActive') }}</button>`;
                }
            },
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                <a class="modal-effect btn btn-warning btn-sm" 
                data-effect="effect-scale"
                id = "Details"
                data-id="${data.id}" 
                data-custmer="${data.first_name+ " " + data.last_name ?? ''}" 
                data-custmerphone="${data.mobile_number ?? ''}" 
                data-custmerwhats="${data.num_whats ?? ''}" 
                data-toggle="modal" href="#exampleModal2" title="تفاصيل">
                <i class="fas fa-eye"></i>
                Details
                </a>
                @can('customer-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteAdmin" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan
                `;
            },
        },
    ],
});
//  view modal admin
$(document).on('click', '#ShowModalAddAdmin', function(e) {
    e.preventDefault();
    $('#modalAddAdmin').modal('show');
});
$(document).on('click', '#DeleteAdmin', function(e) {
    e.preventDefault();
    var id_admin = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("admin/admin/delete/") }}/' + id_admin,
        data: '',
        contentType: false,
        processData: false,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});

$(document).on('click', '#active', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == "active") {
        status = "inactive";
    } else {
        status = "pending_activation";
    }
    var data = {
        id: edit_id,
        status: status
    };
    // console.log(status);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("admin.status") }}',
        data: data,
        success: function(response) {
            // $('#error_message').html("");
            // $('#error_message').addClass("alert alert-danger");
            // $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#pending_activation', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == "pending_activation") {
        status = "active";
    } else {
        status = "inactive";
    }
    var data = {
        id: edit_id,
        status: status
    };
    // console.log(status);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("admin.status") }}',
        data: data,
        success: function(response) {
            // $('#error_message').html("");
            // $('#error_message').addClass("alert alert-danger");
            // $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#inactive', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == "inactive") {
        status = "pending_activation";
    } else {
        status = "active";
    }
    var data = {
        id: edit_id,
        status: status
    };
    // console.log(status);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("admin.status") }}',
        data: data,
        success: function(response) {
            // $('#error_message').html("");
            // $('#error_message').addClass("alert alert-danger");
            // $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});

$(document).on('click', '#Details', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var worker = $(this).data('custmer');
    var workerphone = $(this).data('custmerphone');
    var custmerwhats = $(this).data('custmerwhats');
    $('#idorder').text(id);
    $('#custmer12').text(worker);
    $('#phone12').text(workerphone);
    $('#custmer_whats').text(custmerwhats);
 
});
</script>


@endsection