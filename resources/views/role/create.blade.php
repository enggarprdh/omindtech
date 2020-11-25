@extends('layout/main-app')
@section('title','Role')

@section('container')
<script src="{{asset('script/role/create.js')}}" type="text/javascript"></script>
<script src="{{asset('assets\libs\multilevel-checkbox\multilevel-checkbox.min.js')}}" type="text/javascript"></script>
<script>
    var urlPage = "{{route('role')}}";
    var urlListPlugin = "{{url('/role/getdatafeature')}}";
    var urlSaveRole = "{{route('save_role')}}";
    var lang = {
        delete: "@lang('basic.delete')",
        selectFeature : "@lang('role.select_feature')"
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
                        <a href="{{url('/role')}}" class="btn btn-outline-primary waves-effect waves-light">
                            <i class="bx bx-arrow-back font-size-16 align-middle mr-2"></i> 
                            @lang('basic.back')
                        </a>
                    </div>
                        <h4 class="mb-0 font-size-18">@lang('role.add_role')</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-2">
                                <form id="form1" method="POST" class="custom-validation" action="/role">
                                    @csrf
                                    <div class="form-group position-relative">
                                        <label for="code">@lang('role.code')</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="@lang('role.enter_role_code')" required>
                                        <div class="invalid-feedback">
                                            @lang('role.role_code_required')
                                        </div>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="name">@lang('role.name')</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('role.enter_role_name')" required>
                                        <div class="invalid-feedback">
                                            @lang('role.role_name_required')
                                        </div>
                                    </div>
                                
                                    <button onclick="Save()" class="btn btn-primary pull-right" type="button"><i class="bx bx-save font-size-16 align-middle mr-2"></i>Save</button>
                                </form>
                            </div>

                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="feature">@lang('basic.feature')</label>
                                        <select name="feature" class="form-control select2">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button style="margin-top: 2.1em" onclick="addFeature()" class="btn btn-primary" type="button">
                                            <i class="bx bx-save font-size-16 align-middle mr-2"></i>@lang('role.add_feature')
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="row" style="margin-top: 10px">
                                    <div id="alert-section" class="col-md-12"></div>
                                    <div class="col-md-12">
                                        <table id="dt-feature" class="table table-centered table-nowrap mb-0 clean-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="padding:6px;" width="40%">@lang('basic.plugin')</th>
                                                    <th style="padding:6px;" width="40%">@lang('basic.feature')</th>
                                                    <th style="padding:6px;" width="5%">Create</th>
                                                    <th style="padding:6px;" width="5%">Read</th>
                                                    <th style="padding:6px;" width="5%">Update</th>
                                                    <th style="padding:6px;" width="5%">Delete</th>
                                                    <th class="table-title" width="20%">@lang('basic.action')</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection