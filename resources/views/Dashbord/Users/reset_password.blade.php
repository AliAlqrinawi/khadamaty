@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
 - مورا سوفت للادارة القانونية
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> {{trans('users_admin.users')}} </h4>
{{--            <span class="text-muted mt-1 tx-13 mr-2 mb-0"> / {{trans('users_admin.admin_users')}}</span>--}}
            <span class="text-muted mt-1 tx-13 mr-2 mb-0"> / {{trans('users_admin.change_Password')}}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
 
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif( session('delete') )
    <div class="alert alert-danger ">
        {{ session('delete') }}
    </div>
    @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">

                <br>



                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                      action="{{route('admin.resetPassword')}}" method="post">
                    {{csrf_field()}}
                <div class="">

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('users_admin.password_old')}} : <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                   name="old_password"  type="password">
                        </div>

                        </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('users_admin.password')}} : <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                   name="new_password"  type="password">
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> {{trans('users_admin.password_confirmation')}} : <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                   name="confirm_password" type="password" >
                        </div>
                    </div>


                <div class="mg-t-30">
                    <button class="btn btn-main-primary pd-x-20" type="submit">{{trans('users_admin.Submit')}}</button>
                    <a class="btn btn-secondary" data-effect="effect-scale" style="font-weight: bold; color: beige;"  href="{{url('/')}}">{{trans('users_admin.Close')}}</a>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>




</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
