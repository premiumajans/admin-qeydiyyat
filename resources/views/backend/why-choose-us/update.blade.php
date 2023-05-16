@extends('master.backend')
@section('title',__('menus.why-choose-us'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.why-choose-us.update',$why_choose_us->id) }}" class="needs-validation"
                                  novalidate
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="col-12">
                                        <div
                                            class="page-title-box d-sm-flex align-items-center justify-content-between">
                                            <h4 class="mb-sm-0">@lang('backend.new') @lang('menus.why-choose-us')</h4>
                                        </div>
                                        <a href="https://fontawesome.com/v4/icons/" class="d-flex justify-content-center mb-3" target="_blank">
                                            Bu linkə tıklayaraq iconların sadəcə classlarını götürerek icon fomrasına qoya bilersiz
                                        </a>
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
                                            <label>@lang('backend.icon') <span class="text-danger">*</span></label>
                                            <input name="icon" type="text"
                                                    value="{{ $why_choose_us->icon }}"
                                                   class="form-control" required=""
                                                   data-parsley-minlength="6"
                                                   placeholder="@lang('backend.icon')">
                                            <div class="valid-feedback">    
                                                @lang('backend.title') @lang('messages.is-correct')
                                            </div>
                                            <div class="invalid-feedback">
                                                @lang('backend.title') @lang('messages.not-correct')
                                            </div>
                                        </div>
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}" role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.title') <span class="text-danger">*</span></label>
                                                        <input name="title[{{ $lan->code }}]" type="text"
                                                               class="form-control" required=""
                                                               data-parsley-minlength="6"
                                                               value="{{ $why_choose_us->translate($lan->code)->title }}">
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
                                                        <textarea name="content[{{ $lan->code }}]" type="text"
                                                                  class="form-control" required=""
                                                                  rows="6">{{ $why_choose_us->translate($lan->code)->content }}</textarea>
                                                        <div class="valid-feedback">
                                                            @lang('backend.content') @lang('messages.is-correct')
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @lang('backend.content') @lang('messages.not-correct')
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
