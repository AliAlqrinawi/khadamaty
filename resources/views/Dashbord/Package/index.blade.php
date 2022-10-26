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
                {{ trans('payment.content_title')}}</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div class="main-body">
    <div id="error_message"></div>
    <div class="modal" id="modalAddPayment">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Payments</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="formPayment" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">{{ trans('category.Title_E') }} :</label>
                                <input type="text" class="form-control" name="title_en" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">{{ trans('category.Title_A') }} :</label>
                                <input type="text" class="form-control" name="title_ar" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">{{ trans('clothes.Price') }} :</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">{{ trans('coupons.End_At') }} :</label>
                                <input type="datetime-local" class="form-control" name="duration" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success AddPayment"
                                id="AddPayment">{{ trans('category.Save') }}</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('category.Close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->
    <div class="modal" id="modalEditPayment">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Payments</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="formeditadmin" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="id_Payment">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">{{ trans('category.Title_E') }} :</label>
                                <input type="text" class="form-control" id="title_en" name="title_en" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">{{ trans('category.Title_A') }} :</label>
                                <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">{{ trans('clothes.Price') }} :</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">{{ trans('coupons.End_At') }} :</label>
                                <input type="datetime-local" class="form-control" id="duration" name="duration" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"
                                id="EditClient">{{ trans('category.Save') }}</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('category.Close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('package-create')
                    <div class="row row-xs wd-xl-80p">
                        <div class="col-sm-6 col-md-3 mg-t-10">
                            <button class="btn btn-info-gradient btn-block" id="ShowModalAddPayment">
                                <a href="#" style="font-weight: bold; color: beige;">{{ trans('payment.add')}}</a>
                            </button>
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        @can('package-view')
                        <table class="table table-hover" id="get_Payments" style=" text-align: center;">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ trans('app_users.name') }}</th>
                                    <th class="border-bottom-0">{{ trans('clothes.Price') }}</th>
                                    <th class="border-bottom-0">{{ trans('coupons.End_At') }}</th>
                                    <th class="border-bottom-0">
                                        @canany([ 'package-update' , 'package-delete' ])
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
var table = $('#get_Payments').DataTable({
    // processing: true,
    ajax: '{!! route("get_packages") !!}',
    columns: [
        {
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                if (local == "en") {
                    return data.title_en;
                } else {
                    return data.title_ar;
                }
            },
        },
        {
            'data': 'price',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': 'duration',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                @can('package-update')
                <button class="modal-effect btn btn-sm btn-info" id="ShowModalEditPayment" data-id="${data.id}"><i class="las la-pen"></i></button>
                @endcan
                @can('package-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeletePayment" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan
                `;
            },
            orderable: false,
            searchable: false
        },
    ],
});
//  view modal Payment
$(document).on('click', '#ShowModalAddPayment', function(e) {
    e.preventDefault();
    $('#modalAddPayment').modal('show');
});
// Payment admin
$(document).on('click', '.AddPayment', function(e) {
    e.preventDefault();
    let formdata = new FormData($('#formPayment')[0]);
    // console.log(formdata);
    // console.log("formdata");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("add_package") }}',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log("Done");
            $('#AddPayment').text('Saving');
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-info");
            $('#error_message').text(response.message);
            $('#modalAddPayment').modal('hide');
            $('#formPayment')[0].reset();
            table.ajax.reload();
        }
    });
});
// view modification data
$(document).on('click', '#ShowModalEditPayment', function(e) {
    e.preventDefault();
    var id_Payment = $(this).data('id');
    $('#modalEditPayment').modal('show');
    $.ajax({
        type: 'GET',
        url: '{{ url("admin/package/edit") }}/' + id_Payment,
        data: "",
        success: function(response) {
            console.log(response);
            if (response.status == 404) {
                console.log('error');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#id_Payment').val(id_Payment);
                $('#title_en').val(response.data.title_en);
                $('#title_ar').val(response.data.title_ar);
                $('#duration').val(response.data.duration);
                $('#price').val(response.data.price);
            }
        }
    });
});
$(document).on('click', '#EditClient', function(e) {
    e.preventDefault();
    var data = {
        title_en: $('#title_en').val(),
        title_ar: $('#title_ar').val(),
        duration: $('#duration').val(),
        price: $('#price').val(),
    };
    // let formdata = new FormData($('#formeditadmin')[0]);
    var id_Payment = $('#id_Payment').val();
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("admin/package/update") }}/' + id_Payment,
        data: data,
        dataType: false,
        success: function(response) {
            console.log(response);
            if (response.status == 400) {
                // errors
                $('#list_error_messagee').html("");
                $('#list_error_messagee').addClass("alert alert-danger");
                $.each(response.errors, function(key, error_value) {
                    $('#list_error_messagee').append('<li>' + error_value + '</li>');
                });
            } else if (response.status == 404) {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#EditClient').text('Saving');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-info");
                $('#error_message').text(response.message);
                $('#modalEditPayment').modal('hide');
                table.ajax.reload();
            }
        }
    });
});
$(document).on('click', '#DeletePayment', function(e) {
    e.preventDefault();
    var id_Payment = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("admin/package/delete") }}/' + id_Payment,
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
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == 1) {
        status = 0;
    } else {
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
        url: '{{ route("package.status") }}',
        data: data,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#statusoff', function(e) {
    e.preventDefault();
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == 1) {
        status = 0;
    } else {
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
        url: '{{ route("package.status") }}',
        data: data,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
</script>
@endsection