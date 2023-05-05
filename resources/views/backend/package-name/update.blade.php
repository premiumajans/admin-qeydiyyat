@extends('master.backend')
@section('title',__('menus.package-name'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.package-name.update',$packageName->id) }}" class="needs-validation"
                                  novalidate
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.new') @lang('menus.package-name')</h4>
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
                                                        <label>@lang('backend.package-name') <span class="text-danger">*</span></label>
                                                        <input name="title[{{ $lan->code }}]" type="text"
                                                               class="form-control" required=""
                                                               data-parsley-minlength="6"
                                                               value="{{ $packageName->translate($lan->code)->title }}">
                                                        <div class="valid-feedback">
                                                            @lang('backend.package-name') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.package-name') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.price') <span class="text-danger">*</span></label>
                                                        <input name="price[{{ $lan->code }}]" type="text" 
                                                            value="{{ $packageName->translate($lan->code)->price }}"
                                                            class="form-control" required="" data-parsley-minlength="6"
                                                            placeholder="@lang('backend.price')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.price') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.price') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.exchange') <span class="text-danger">*</span></label>
                                                       <select name="exchange" class="form-control" required>
                                                            <option value="">@lang('backend.exchange-choose')</option>
                                                            <option value="AZN" {{ $packageName == 'AZN' ? 'selected' : '' }}>AZN</option>
                                                            <option value="USD" {{ $packageName == 'USD' ? 'selected' : '' }}>USD</option>
                                                            <option value="RUBL" {{ $packageName == 'RUBL' ? 'selected' : '' }}>RUBL</option>
                                                        </select>
                                                       <div class="valid-feedback">
                                                            @lang('backend.exchange') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.exchange') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.alt') <span
                                                                class="text-danger">*</span></label>
                                                        <input name="alt[{{ $lan->code }}]" type="text"
                                                            value="{{ $packageName->translate($lan->code)->alt }}"
                                                               class="form-control" required=""
                                                               data-parsley-minlength="6"
                                                               placeholder="@lang('backend.alt')">
                                                        <div class="valid-feedback">
                                                            @lang('backend.alt') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.alt') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
