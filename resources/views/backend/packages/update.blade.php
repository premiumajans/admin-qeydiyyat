@extends('master.backend')
@section('title',__('menus.packages'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.packages.update',$package->id) }}"
                                class="needs-validation" novalidate method="post" >
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('menus.packages')</h4>
                                        </div>
                                    </div>
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        @foreach(active_langs() as $lan)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab"
                                                   href="#{{ $lan->code }}" role="tab" aria-selected="true">
                                                    <span class="d-block d-sm-none"><i>{{ $lan->code }}</i></span>
                                                    <span class="d-none d-sm-block">{{ $lan->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content p-3 text-muted">
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}" role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.title') <span class="text-danger">*</span></label>
                                                        <input name="title[{{ $lan->code }}]" type="text"
                                                                value="{{ $package->translate($lan->code)->title }}"
                                                                class="form-control" required=""
                                                                data-parsley-minlength="6"
                                                                placeholder="@lang('backend.title')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.title') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.title') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.monthlyPrice') <span class="text-danger">*</span></label>
                                                        <input name="monthlyPrice[{{ $lan->code }}]" type="text"
                                                            value="{{ $package->translate($lan->code)->monthlyPrice }}"
                                                            class="form-control" required="" data-parsley-minlength="6"
                                                            placeholder="@lang('backend.monthlyPrice')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.monthlyPrice') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.monthlyPrice') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.annualyPrice') <span class="text-danger">*</span></label>
                                                        <input name="annualyPrice[{{ $lan->code }}]" type="text"
                                                            value="{{ $package->translate($lan->code)->annualyPrice }}"
                                                            class="form-control" required="" data-parsley-minlength="6"
                                                            placeholder="@lang('backend.annualyPrice')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.annualyPrice') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.annualyPrice') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.exchange') <span class="text-danger">*</span></label>
                                                        <select name="exchange[{{ $lan->code }}]" class="form-control">
                                                            <option value="">@lang('backend.exchange-choose')</option>
                                                            <option value="AZN" {{ ($package->translate($lan->code)->exchange == 'AZN') ? 'selected' : '' }}>AZN</option>
                                                            <option value="USD" {{ ($package->translate($lan->code)->exchange == 'USD') ? 'selected' : '' }}>USD</option>
                                                            <option value="RUBL" {{ ($package->translate($lan->code)->exchange == 'RUBL') ? 'selected' : '' }}>RUBL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="form-check">
                                            <input name="most_popular" type="checkbox" {{ $package->most_popular == 1 ? 'checked' : ''}}
                                                class="form-check-input">
                                            <label class="form-check-label"
                                                for="flexCheckDefault">@lang('backend.popularPackage')</label>
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

