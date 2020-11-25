@extends('layout/main-app')
@section('title','User')


@section('container')
<script src="{{asset('script/user/create.js')}}" type="text/javascript"></script>
<script>
    var urlRoleDropdown = "{{route('get_role_dropdown')}}";
    var urlUserSave = "{{route('save_user')}}";
    var urlPage = "{{route('user')}}";
</script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title-left">
                        <a href="{{url('/user')}}" class="btn btn-outline-primary waves-effect waves-light">
                            <i class="bx bx-arrow-back font-size-16 align-middle mr-2"></i> 
                            @lang('basic.back')
                        </a>
                    </div>
                        <h4 class="mb-0 font-size-18">@lang('user.add_user')</h4>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" id="form1" class="custom-validation" action="/user">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="wrapper-form-group">
                                        <div class="row title-form-group">
                                            <div class="col-12">
                                                <h5 class="card-title"><b>@lang('user.user_information')</b></h5>
                                            </div>
                                        </div>
                                        <div class="row body-form-group">
                                            <div class="col-12">
                                                <div class="form-group row mb4 position-relative">
                                                    <label for="firstname" class="col-form-label col-lg-2">@lang('user.first_name')</label>
                                                    <div class="col-lg-10">
                                                        <input id="firstname" name="firstname" type="text" class="form-control" required/>
                                                        <div class="invalid-feedback">
                                                            @lang('user.first_name_required')
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb4">
                                                    <label for="lastname" class="col-form-label col-lg-2">@lang('user.last_name')</label>
                                                    <div class="col-lg-10">
                                                        <input id="lastname" name="lastname" type="text" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wrapper-form-group">
                                        <div class="row title-form-group">
                                            <div class="col-12">
                                                <h5 class="card-title"><b>@lang('user.account_information')</b></h5>
                                            </div>
                                        </div>
                                        <div class="row body-form-group">
                                            <div class="col-12">
                                                <div class="form-group row mb4 position-relative">
                                                    <label for="role" class="col-form-label col-lg-2">@lang('role.role')</label>
                                                    <div class="col-lg-10">
                                                        <select id="role" name="role" class="form-control" required>
                                                            <option></option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            @lang('user.role_required')
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb4 position-relative">
                                                    <label for="email" class="col-form-label col-lg-2">@lang('user.email')</label>
                                                    <div class="col-lg-10">
                                                        <input id="email" name="email" type="email" class="form-control" required/>
                                                        <div class="example-section">
                                                            @lang('basic.example'): example@mail.com
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('user.email_required')
                                                        </div>
                                                    </div>
                                                   
                                                </div>

                                                <div class="form-group row mb4 position-relative">
                                                    <label for="password" class="col-form-label col-lg-2">@lang('user.password')</label>
                                                    <div class="col-lg-10">

                                                        <div class="input-group">
                                                            <input id="password" name="password" type="password" class="form-control" aria-describedby="showpass" required/>
                                                            <div class="input-group-prepend">
                                                                <span id="showpass" class="input-group-text"><i class="mdi mdi-eye"></i></span>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                @lang('user.password_required')
                                                            </div>
                                                                                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="btn-section">
                                <button onclick="Save()" class="btn btn-primary pull-right" type="button"><i class="bx bx-save font-size-16 align-middle mr-2"></i>@lang('basic.save')</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">@lang('user.user_image')</h4>

                        <form action="{{route('upload_avatar')}}" method="POST" class="dropzone" enctype="multipart/form-data">
                            @csrf
                            <div class="fallback">
                                <input id="upload" name="upload" type="file" multiple />
                            </div>

                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                </div>
                                
                                <h4>@lang('user.drop_file_upload')</h4>
                            </div>
                        </form>
                    </div>

                </div> 
            </div>
        </div>
    </div>
</div>

@endsection