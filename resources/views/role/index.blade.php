@extends('layout/main-app')
@section('title','Role')

@section('container')
<script src="{{asset('script/role/index.js')}}" type="text/javascript"></script>
<script>
    var urlEdit = "{{route('role')}}";
    var urlGetRole = "{{route('get_role')}}";
    var lang = {
        edit: "@lang('basic.edit')",
        delete: "@lang('basic.delete')",
        inActive: "@lang('basic.inActive')",
        active: "@lang('basic.active')",
        confirmation: "@lang('basic.confirmation')",
        confirmationStatus: "@lang('role.confirmation_status')",
        confirmationDelete: "@lang('role.confirmation_delete')",
        confirmationSuccess: "@lang('role.confirmation_success_status')",
        confirmationDelete: "@lang('role.confirmation_success_delete')"
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
                        <a href="{{route('create_role')}}" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-plus-circle font-size-16 align-middle mr-2"></i> 
                            @lang('role.add_role')
                        </a>
                    </div>
                    
                    <h4 class="mb-0 font-size-18">@lang('role.role')</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="dt-role" class="table table-centered table-nowrap mb-0 clean-table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="table-title">@lang('role.code')</th>
                                    <th class="table-title">@lang('role.name')</th>
                                    <th class="table-title">Status</th>
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
