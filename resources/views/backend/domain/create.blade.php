@extends('master.backend')
@section('title', __('backend.domain'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.domain.store') }}" class="needs-validation" novalidate
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.domain')</h4>
                                        </div>
                                    </div>
                                    <div class="tab-content p-3 text-muted">
                                        <div class="form-group row">
                                            <div class="mb-3">
                                                <label>@lang('backend.domain') <span class="text-danger">*</span></label>
                                                <input name="title" type="text" class="form-control" required
                                                    data-parsley-minlength="6" placeholder="@lang('backend.domain')">
                                                <div class="valid-feedback">
                                                    @lang('backend.domain') @lang('messages.is-correct')
                                                </div>
                                                <div class="invalid-feedback">
                                                    @lang('backend.domain') @lang('messages.not-correct')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="mb-3">
                                                <label>@lang('backend.price') <span class="text-danger">*</span></label>
                                                <input name="price" type="number" class="form-control" required
                                                    data-parsley-minlength="6" placeholder="@lang('backend.price')">
                                                <div class="valid-feedback">
                                                    @lang('backend.price') @lang('messages.is-correct')
                                                </div>
                                                <div class="invalid-feedback">
                                                    @lang('backend.price') @lang('messages.not-correct')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="mb-3">
                                                <label>@lang('backend.domain_time_increase_price') <span class="text-danger">*</span></label>
                                                <input name="domain_time_increase_price" type="number" class="form-control" required
                                                    data-parsley-minlength="6" placeholder="@lang('backend.domain_time_increase_price')">
                                                <div class="valid-feedback">
                                                    @lang('backend.domain_time_increase_price') @lang('messages.is-correct')
                                                </div>
                                                <div class="invalid-feedback">
                                                    @lang('backend.domain_time_increase_price') @lang('messages.not-correct')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="mb-3">
                                                <label>@lang('backend.transfer_price') <span class="text-danger">*</span></label>
                                                <input name="transfer_price" type="number" class="form-control" required
                                                    data-parsley-minlength="6" placeholder="@lang('backend.transfer_price')">
                                                <div class="valid-feedback">
                                                    @lang('backend.transfer_price') @lang('messages.is-correct')
                                                </div>
                                                <div class="invalid-feedback">
                                                    @lang('backend.transfer_price') @lang('messages.not-correct')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label>@lang('backend.exchange') <span class="text-danger">*</span></label>
                                            <select name="exchange" class="form-control" required>
                                                <option value="">@lang('backend.exchange-choose')</option>
                                                <option value="AZN">AZN</option>
                                                <option value="USD">USD</option>
                                                <option value="RUBL">RUBL</option>
                                            </select>
                                            <div class="valid-feedback">
                                                @lang('backend.exchange') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.exchange') @lang('messages.not-correct')
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
