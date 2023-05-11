@extends('master.backend')
@section('title', __('menus.partner'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.partner.store') }}" class="needs-validation" novalidate
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('menus.partner')</h4>
                                        </div>
                                    </div>
                                    <div class="tab-content p-3 text-muted">
                                        <div class="mb-3">
                                            <label>@lang('backend.image') <span class="text-danger">*</span></label>
                                            <input type="file" name="image" class="form-control" required=""
                                                id="validationCustom">
                                            <div class="valid-feedback">
                                                @lang('backend.image') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.image') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="mb-3">
                                                <label>@lang('backend.link') <span class="text-danger"></span></label>
                                                <input name="link" type="text" class="form-control"
                                                    data-parsley-minlength="6" placeholder="@lang('backend.link')">
                                                <div class="valid-feedback">
                                                    @lang('backend.link') @lang('messages.is-correct')
                                                </div>
                                                <div class="invalid-feedback">
                                                    @lang('backend.link') @lang('messages.not-correct')
                                                </div>
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
