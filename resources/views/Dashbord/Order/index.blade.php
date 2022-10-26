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
            <h4 class="content-title mb-0 my-auto">{{ trans('admins.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
            {{ trans('orders.page_title') }}</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div class="main-body">
<div id="error_message"></div>
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
                                    <th>{{ trans('orders.order_num') }}</th>
                                    <td id="idorder"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.custmer_num') }}</th>
                                    <td id="custmer_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.custmer') }}</th>
                                    <td id="custmer_name"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('admins.phone') }}</th>
                                    <td id="custmer_phone"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.worker_num') }}</th>
                                    <td id="worker_id"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.worker') }}</th>
                                    <td id="worker_name"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('admins.phone') }}</th>
                                    <td id="worker_phone"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.workercat') }}</th>
                                    <td id="worker_cat"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('orders.created_at') }}</th>
                                    <td id="order_date"></td>
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
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                @can('order-view')
                    <table class="table table-hover" id="get_orders" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{ trans('orders.custmer') }}</th>
                                <th class="border-bottom-0">{{ trans('orders.worker') }}</th>
                                <th class="border-bottom-0">{{ trans('orders.workercat') }}</th>
                                <th class="border-bottom-0">{{ trans('orders.created_at') }}</th>
                                <th class="border-bottom-0">{{ trans('category.Status') }}</th>
                                <th class="border-bottom-0">
                                @canany([ 'order-update' , 'order-delete' ])
                                {{ trans('category.Processes') }}
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
var table = $('#get_orders').DataTable({
    // processing: true,
    ajax: '{!! route("get_orders") !!}',
    columns: [
        {
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                return data.custmers.first_name+ " " + data.custmers.last_name;
            },
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                return data.workers.first_name+ " " + data.workers.last_name;
            },
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                if (local == "en") {
                    return data.workers.categories.title_en;
                } else {
                    return data.workers.categories.title_ar;
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
                if (data.status == '1') {
                    return `<button class="btn btn-success-gradient btn-block" id="status" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.new') }}</button>`;
                }else if(data.status == '2'){

                }else if(data.status == '3'){

                }else if(data.status == '4'){

                }else if(data.status == '5'){

                }else {
                    return `<button class="btn btn-danger-gradient btn-block" id="statusoff" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.iActive') }}</button>`;
                }
            },
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                @can('order-view')
                <a class="modal-effect btn btn-warning btn-sm" 
                data-effect="effect-scale"
                id = "Details"
                data-id="${data.id}" 
                data-custmer="${data.custmers.first_name+ " " + data.custmers.last_name ?? ''}"
                data-worker="${data.workers.first_name+ " " + data.workers.last_name ?? ''}" 
                data-workercat="${data.workers.categories.title_ar ?? ''}" 
                data-workerphone="${data.workers.mobile_number ?? ''}" 
                data-custmerphone="${data.custmers.mobile_number ?? ''}"
                data-custmerid="${data.custmers.id ?? ''}"
                data-workerid="${data.workers.id ?? ''}"
                data-orderdate="${data.created_at}" 
                data-toggle="modal" href="#exampleModal2" title="تفاصيل">
                <i class="fas fa-eye"></i>
                Details
                </a>
                @endcan
                @can('order-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteCategory" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan`;
            },
        },
    ],
});
$(document).on('click', '#DeleteCategory', function(e) {
    e.preventDefault();
    var id_order = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("admin/order/delete") }}/' + id_order,
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
$(document).on('click', '#status', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if(status == 1){
        status = 0;
    }else{
        status = 1;
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
        url: '{{ route("update.status") }}',
        data: data,
        success: function(response) {
            // $('#error_message').html("");
            // $('#error_message').addClass("alert alert-danger");
            // $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#statusoff', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if(status == 1){
        status = 0;
    }else{
        status = 1;
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
        url: '{{ route("update.status") }}',
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
    var custmerid = $(this).data('custmerid');
    var workerid = $(this).data('workerid');
    var custmer = $(this).data('custmer');
    var worker = $(this).data('worker');
    var workercat = $(this).data('workercat');
    var workerphone = $(this).data('workerphone');
    var custmerphone = $(this).data('custmerphone');
    var orderdate = $(this).data('orderdate');
    $('#idorder').text(id);
    $('#custmer_id').text(custmerid);
    $('#worker_id').text(workerid);
    $('#custmer_name').text(custmer);
    $('#worker_name').text(worker);
    $('#worker_cat').text(workercat);
    $('#worker_phone').text(workerphone);
    $('#custmer_phone').text(custmerphone);
    $('#order_date').text(orderdate);
});
</script>

@endsection
