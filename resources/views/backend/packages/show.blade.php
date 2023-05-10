@extends('master.backend')
@section('title', __('menus.packages'))
@section('styles')
    <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.packages.packageStore', $package->id) }}"
                                class="needs-validation" novalidate method="post">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                <div class="card-body text-center">
                                    <h3 class="role-title">@lang('backend.packageComponentChoose')</h3>
                                    <input type="checkbox" name="checkAll" id="checkAll" class="form-check-input" />
                                    <label class="form-check-label" for="checkAll">
                                        @lang('backend.selectAll')
                                    </label>
                                    @foreach ($components as $component)
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="component_id[]" value="{{ $component->id }}" 
                                                {{ $package->component->contains($component->id) ? 'checked' : '' }}
                                                class="form-check-input" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">{{ $component->title }}</label>
                                        </div>
                                    @endforeach
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
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>@lang('backend.package-name'):</th>
                                <th>@lang('backend.package-components'):</th>
                                <th>@lang('backend.time'):</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $package->translate('az')->title }}</td>
                                <td class="text-center">
                                    @foreach ($package->component as $i => $package)
                                        {{ $package->translate('az')->title . ',' }}<br>
                                    @endforeach
                                </td>
                                <td>{{ date('d.m.Y H:i:s', strtotime($package->created_at)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#checkAll').click(function() {
            $('input[type=checkbox]').prop('checked', this.checked);
        });
    </script>
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
