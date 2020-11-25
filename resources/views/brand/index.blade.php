@extends('layout/main-app')
@section('title','Role')

@section('container')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <div class="page-title-left">
                        <a href="{{route('create_role')}}" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-plus-circle font-size-16 align-middle mr-2"></i> 
                            @lang('brand.add_brand')
                        </a>
                    </div>
                    
                    <h4 class="mb-0 font-size-18">@lang('brand.brand')</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection