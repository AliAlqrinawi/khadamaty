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
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                @can('categories-view')
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
                                @canany([ 'categories-update' , 'categories-delete' ])
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
                @can('categories-delete')
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
</script>

@endsection
