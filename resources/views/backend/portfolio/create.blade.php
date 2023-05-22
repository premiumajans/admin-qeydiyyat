@extends('master.backend')
@section('title',__('backend.portfolio'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.portfolio.store') }}" class="needs-validation" novalidate
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.portfolio')</h4>
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
                                        <div class="mb-3">
                                            <label>@lang('backend.link') <span class="text-danger">*</span></label>
                                            <input type="text" name="link" class="form-control" required=""
                                                   id="validationCustom">
                                            <div class="valid-feedback">
                                                @lang('backend.link') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.link') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}" role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.title') <span class="text-danger">*</span></label>
                                                        <input name="title[{{ $lan->code }}]" type="text"
                                                               class="form-control" 
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
                                                        <label>@lang('backend.content') <span
                                                                class="text-danger">*</span></label>
                                                        <textarea type="text" name="content[{{ $lan->code }}]"
                                                                   class="form-control" id="validationCustom"
                                                                  rows="7"
                                                                  placeholder="@lang('backend.content')"></textarea>
                                                        <div class="valid-feedback">
                                                            @lang('backend.content') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.content') @lang('messages.not-correct')
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.alt') <span
                                                                class="text-danger">*</span></label>
                                                        <input name="alt[{{ $lan->code }}]" type="text"
                                                               class="form-control"
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

