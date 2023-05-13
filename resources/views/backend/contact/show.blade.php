@extends('master.backend')
@section('title', __('backend.contact'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.contact')</h4>
                                    </div>
                                </div>
                                <div class="tab-content p-3 text-muted">
                                    <b>@lang('backend.name'):</b> {{ $contact->name }}<br>
                                    <b>@lang('backend.email'):</b> {{ $contact->email }}<br>
                                    <b>@lang('backend.phone'):</b> {{ $contact->phone }}<br>
                                    <b>@lang('backend.subject'):</b> {{ $contact->subject }}<br>
                                    <b>@lang('backend.message'):</b><br> {{ $contact->message }}<br><br>
                                    <a href="mailto:{{ $contact->email }}" type="button" class="btn btn-primary waves-effect">
                                        @lang('backend.reply')
                                    </a>
                                    <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary waves-effect">
                                        @lang('backend.cancel')
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 text-center">
                            <div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
