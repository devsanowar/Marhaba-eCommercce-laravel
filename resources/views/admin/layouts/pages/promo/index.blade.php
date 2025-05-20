@extends('admin.layouts.app')
@section('title', 'Promo Banner')

@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />


    <style>
        .form-line.case-input {
            border: 1px solid #8a8a8a;
        }

        .input-group .input-group-addon {
            padding-left: 10px;
        }

        .input-group .input-group-addon+.form-line {
            padding-left: 35px;
        }

        .bootstrap-select.btn-group.show-tick>.btn {
            border: 1px solid #444 !important;
            padding-left: 10px;
            color: #888;
            font-size: 17px;
            padding-bottom: 0;
            font-weight: 300;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .480em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }



        .bootstrap-select>.dropdown-toggle.bs-placeholder,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:hover,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:focus,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:active {
            color: #444;
        }



        .form-group .form-line.access_info {
            border: 1px solid #424242 !important;
            padding-left: 10px;
        }

        .btn.btn-primary.btn-lg.custom_btn {
            padding: 10px 15px;
        }

        .btn-primary:not(:disabled):not(.disabled).active,
        .btn-primary:not(:disabled):not(.disabled):active,
        .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #0062cc !important;
            border-color: #005cbf;
        }
    </style>
@endpush


@section('admin_content')


    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            All Promo Banner
                            <span>
                                <!-- Button to trigger modal -->
                                <button type="button" class="btn btn-warning text-white text-uppercase text-bold right"
                                    data-toggle="modal" data-target="#addPromoBannerModal">
                                    + Add New
                                </button>
                            </span>
                        </h4>
                    </div>
                    <div class="body">
                        <table id="upazilaDataTable"
                            class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th style="width: 60px">S/N</th>
                                    <th>promobanner Name</th>
                                    <th style="width: 60px">Status</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($promobanners as $key => $promobanner)
                                    <tr id="promoBannerRow-{{ $promobanner->id }}">
                                        <td>{{ $promobanner->id }}</td>
                                        <td class="promobanner-image"><img src="{{ asset($promobanner->image) }}"
                                                alt="image" width="60"></td>

                                        <td>
                                            <button data-id="{{ $promobanner->id }}"
                                                class="btn btn-sm status-toggle-btn {{ $promobanner->is_active ? 'btn-success' : 'btn-danger' }}">
                                                {{ $promobanner->is_active ? 'Active' : 'DeActive' }}
                                            </button>
                                        </td>
                                        <td>

                                            <a href="javascript:void(0)" class="btn btn-warning btn-sm editPromoBanner"
                                                data-id="{{ $promobanner->id }}"
                                                data-image="{{ asset($promobanner->image) }}"
                                                data-status="{{ $promobanner->is_active }}">
                                                <i class="material-icons text-white">edit</i>
                                            </a>


                                            <form class="d-inline-block"
                                                action="{{ route('promobanner.destroy', $promobanner->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm_delete">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!--Add promobanner Bootstrap Modal -->
                    @include('admin.layouts.pages.promo.create')


                    <!-- Edit promobanner Modal -->
                    @include('admin.layouts.pages.promo.edit')




                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <!-- Jquery DataTable Plugin Js -->

    <script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>

    <!-- Script For status change -->
    <script>
        const promobannerStatusRoute = "{{ route('promobanner.status') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('backend') }}/assets/js/promobanner.js"></script>
@endpush
