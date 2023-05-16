@extends('master.backend')
@section('title',__('backend.faq'))
@section('styles')
<link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('backend/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">@lang('backend.faq'):</h4>
                            <a href="{{ route('backend.faq.create') }}" class="btn btn-primary mb-3"><i
                                    class="fas fa-plus"></i> &nbsp;@lang('backend.add-new')
                            </a>
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('backend.title'):</th>
                                <th>@lang('backend.content'):</th>
                                <th>@lang('backend.time'):</th>
                                <th>@lang('backend.actions'):</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $i=>$faq)
                            <tr>
                                <td class="text-center">{{ $i+=1 }}</td>
                                <td class="text-center">{{ $faq->translate('az')->title }}</td>
                                <td class="text-center">{{ $faq->translate('az')->content }}</td>
                                <td>{{ date('d.m.Y H:i:s',strtotime($faq->created_at))}}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary"
                                        href={{ route('backend.faq.edit',$faq->id) }}>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger"
                                        href="{{ route('backend.faq.destroy',$faq->id) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('backend/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/datatables.init.js') }}"></script>
@endsection
