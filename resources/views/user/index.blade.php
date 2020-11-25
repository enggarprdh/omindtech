@extends('layout/main-app')
@section('title','User')


@section('container')
<script src="{{asset('script/user/index.js')}}" type="text/javascript"></script>
<script>
    var urlBaseUser = "{{route('user')}}";
    var urlGetUser = "{{route('get_user')}}";
    var lang = {
        edit: "@lang('basic.edit')",
        delete: "@lang('basic.delete')",
        inActive: "@lang('basic.inActive')",
        active: "@lang('basic.active')",
        confirmation: "@lang('basic.confirmation')",
        confirmationStatus: "@lang('user.confirmation_status')",
        confirmationDelete: "@lang('user.confirmation_delete')",
        confirmationSuccessStatus: "@lang('user.confirmation_success_status')"

    };
    var langDT = {
        next : "@lang('datatable.Next')",
        previous : "@lang('datatable.Previous')",
        search : "@lang('datatable.Search')",
        processing: "@lang('datatable.Processing')",
        info: "@lang('datatable.Info')",
        lengthMenu : "@lang('datatable.LengthMenu')",
        exportExcel : "@lang('datatable.ExportExcel')",
        exportPDF : "@lang('datatable.ExportPDF')",
        colvis : "@lang('datatable.Colvis')"
    }

</script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="{{route('create_user')}}" class="btn btn-primary waves-effect waves-light">
                                <i class="bx bx-plus-circle font-size-16 align-middle mr-2"></i> 
                                @lang('user.add_user')
                            </a>
                        </div>
                        
                        <h4 class="mb-0 font-size-18">@lang('user.user')</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="dt-user" class="table table-centered table-nowrap mb-0 clean-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="table-title">@lang('user.tenant')</th>
                                        <th class="table-title">@lang('user.first_name')</th>
                                        <th class="table-title">@lang('user.last_name')</th>
                                        <th class="table-title">@lang('user.email')</th>
                                        <th class="table-title">@lang('user.status')</th>
                                        <th class="table-title">@lang('basic.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection