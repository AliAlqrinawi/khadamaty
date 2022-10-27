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
                <form action="{{ route('workers.export') }}" method="post">
                    @csrf
                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-3" id="fnWrapper">
                            <label>{{ trans('orders.worker') }} :</label>
                            <input type="text" class="form-control form-control-md mg-b-20" name="worker"
                                id="worker">
                        </div>
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('orders.phone')}} :</label>
                            <input type="number" class="form-control form-control-md mg-b-20" name="phone"
                                id="phone">
                        </div>
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('orders.workercat')}} :</label>
                            <select class="form-control form-control-md mg-b-20" id="cat_id" name="cat_id">
                                <option value="">{{ trans('orders.all') }}</option>
                                @foreach($cat as $c)
                                    <option value="{{ $c->id }}">{{ $c->title_ar }}</option>
                                @endforeach
                            </select>
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
    @endcan
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        @can('member-view')
                        <table class="table table-hover" id="get_admins" style=" text-align: center;">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ trans('orders.worker') }}</th>
                                    <th class="wd-20p border-bottom-0">{{ trans('admins.phone') }}</th>
                                    <th class="border-bottom-0">{{ trans('orders.workercat') }}</th>
                                    <th class="border-bottom-0">{{ trans('orders.created_at') }}</th>
                                    <th class="border-bottom-0">{{ trans('ads.Status') }}</th>
                                    <th class="border-bottom-0">
                                        @canany([ 'member-update' , 'member-delete' ])
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
    var worker = $('#worker').val();
    var phone = $('#phone').val();
    var cat_id = $('#cat_id').val();
    var payment_status = $('#payment_status').val();

    $('#get_admins').DataTable({
        bDestroy: true,
        processing: true,
        serverSide: true,
        searching: false,
        pageLength: 20,
        ajax: {
            url: '{{route("get_workers")}}/?worker=' + worker + '&phone=' + phone + '&payment_status=' + payment_status + '&cat_id=' + cat_id + '&type=3',
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
            render: function(data, row, type) {
                if(local == 'en'){
                    return data.categories.title_en;
                }else{
                    return data.categories.title_ar;
                }
            },
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
                @can('member-delete')
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
    ajax: '{{ route("get_workers") }}?type=3',
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
            render: function(data, row, type) {
                if(local == 'en'){
                    return data.categories.title_en;
                }else{
                    return data.categories.title_ar;
                }
            },
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
                @can('member-delete')
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
</script>


@endsection