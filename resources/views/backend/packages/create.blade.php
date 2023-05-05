@extends('master.backend')
@section('title',__('menus.packages'))
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="card">
                        <form action="{{ route('backend.packages.store') }}" class="needs-validation" novalidate
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('menus.packages')</h4>
                                    </div>
                                </div>
                                <div class="tab-content p-3 text-muted">
                                    <div class="form-group row">
                                        <div class="mb-3">
                                            <label>@lang('backend.packages') <span class="text-danger">*</span></label>
                                            <select name="package_name_id" class="form-control">
                                                @foreach ($packages as $package)
                                                    @foreach ($package->packageNames as $packageName)
                                                        <option value="{{ $packageName->id }}">{{ $packageName->title }}</option>
                                                        <option value="1">asasassa</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                            {{--  
                                            <select name="package_name_id" class="form-control">
                                                @foreach ($packages as $package)
                                                    @foreach ($package->packageNames as $packageName)
                                                        <option value="{{ $packageName->id }}">{{ $packageName->title }}</option>
                                                        <option value="1">asasassa</option>
                                                    @endforeach
                                                @endforeach
                                            </select> --}}
                                            
                                            {{-- @foreach ($packages as $package)
                                                <select name="package_name_id" class="form-control">
                                                    <option value="{{ $package->package_name_id }}">{{ $package->packageNames->title }}</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    @lang('backend.packages') @lang('messages.is-correct')
                                                </div>
                                                <div class="invalid-feedback">
                                                    @lang('backend.packages') @lang('messages.not-correct')
                                                </div>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5 text-center">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        @lang('backend.submit')
                                    </button>
                                    <a href="{{ url()->previous() }}" type="button"
                                        class="btn btn-secondary waves-effect">
                                        @lang('backend.cancel')
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
