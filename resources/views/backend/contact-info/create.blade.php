@extends('master.backend')
@section('title', __('backend.contact-info'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.contact-info.store') }}" class="needs-validation" novalidate
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.contact-info')</h4>
                                        </div>
                                        <p class="text-center alert alert-warning">
                                            @lang('backend.setting')
                                        </p> 
                                    </div>
                                    <div class="tab-content p-3 text-muted">

                                        <div class="form-group row">
                                            <div class="mb-3">
                                                <label>@lang('backend.title') <span class="text-danger">*</span></label>
                                                <input name="title" type="text" class="form-control" required=""
                                                    data-parsley-minlength="6" placeholder="@lang('backend.title')">
                                                <div class="valid-feedback">
                                                    @lang('backend.title') @lang('messages.is-correct')
                                                </div>
                                                <div class="invalid-feedback">
                                                    @lang('backend.title') @lang('messages.not-correct')
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label>@lang('backend.link') <span class="text-danger">*</span></label>
                                                <textarea type="text" name="link" class="form-control" id="validationCustom" rows="7"
                                                    placeholder="@lang('backend.link')"></textarea>
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
                        </div>
                        <div class="mb-5 text-center">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                    @lang('backend.submit')
                                </button>
                                <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary waves-effect">
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
