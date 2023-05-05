@extends('master.backend')
@section('title',__('menus.why-choose-us'))
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
                            <h4 class="mb-sm-0">@lang('menus.why-choose-us'):</h4>
                            <a href="https://fontawesome.com/v4/icons/" target="_blank">
                                Bu linkə tıklayaraq iconların sadəcə classlarını götürerek icon fomrasına qoya bilersiz
                            </a>
                            <a href="{{ route('backend.why-choose-us.create') }}" class="btn btn-primary mb-3"><i
                                    class="fas fa-plus"></i> &nbsp;@lang('backend.add-new')
                            </a>
                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('backend.icon'):</th>
                                <th>@lang('backend.title'):</th>
                                <th>@lang('backend.content'):</th>
                                <th>@lang('backend.alt'):</th>
                                <th>@lang('backend.time'):</th>
                                <th>@lang('backend.actions'):</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($why_choose_us_all as $i=>$why_choose_us)
                            <tr>
                                <td class="text-center">{{ $i+=1 }}</td>
                                <td class="text-center"><i class="{{ $why_choose_us->icon }}"></i></td>
                                <td class="text-center">{{ $why_choose_us->translate('az')->title }}</td>
                                <td class="text-center">{{ $why_choose_us->content }}</td>
                                <td class="text-center">{{ $why_choose_us->alt }}</td>
                                <td>{{ date('d.m.Y H:i:s',strtotime($why_choose_us->created_at))}}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary"
                                        href={{ route('backend.why-choose-us.edit',$why_choose_us->id) }}>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger"
                                        href="{{ route('backend.why-choose-us.destroy',$why_choose_us->id) }}">
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
