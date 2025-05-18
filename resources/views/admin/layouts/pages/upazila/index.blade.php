@extends('admin.layouts.app')
@section('title', 'All Upazila')

@push('styles')

<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

<script>
    $(document).ready(function() {
        $('.select2').select2({
            minimumResultsForSearch: 0, // Enables search for all dropdowns
            placeholder: "Select Status",
            allowClear: true
        });
    });
</script>

<style>

.form-line.case-input {
	border: 1px solid #8a8a8a;
}

.input-group .input-group-addon {
	padding-left: 10px;
}

.input-group .input-group-addon + .form-line {
	padding-left: 35px;
}

.bootstrap-select.btn-group.show-tick > .btn {
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



.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:active {
	color: #444;
}


.cus-file {
	padding-left: 6px !important;
}


.form-group .form-line.access_info {
	border: 1px solid #424242 !important;
	padding-left: 10px;
}
.btn.btn-primary.btn-lg.custom_btn {
	padding: 10px 15px;
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show > .btn-primary.dropdown-toggle {
	color: #fff;
	background-color: #0062cc !important;
	border-color: #005cbf;
}


</style>



@endpush


@section('admin_content')


@php
    $countDeletedData = App\Models\Product::onlyTrashed()->get();
@endphp

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        All upazila
                        <span>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-warning text-white text-uppercase text-bold right" data-toggle="modal" data-target="#addupazilaModal">
                                + Add New
                            </button>
                        </span>
                    </h4>
                </div>
                <div class="body">
                    <table id="upazilaDataTable" class="table table-bordered table-striped table-hover dataTable js-exportable" >
                        <thead>
                            <tr>
                                <th style="width: 60px">S/N</th>
                                <th>Upazila Name</th>
                                <th>District Name</th>

                                <th style="width: 60px">Status</th>
                                <th style="width: 160px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($upazilas as $key=>$upazila)

                            <tr id="upazilaRow-{{ $upazila->id }}">
                                <td>{{ $key+1 }}</td>
                                <td class="upazila-name">{{ $upazila->upazila_name }}</td>
                                <td class="upazila-name">{{ $upazila->district->district_name }}</td>

                                {{-- <td>
                                    @if($upazila->is_active == 1)
                                        <a href="{{ route('upazila.status',$upazila->id) }}" class="btn btn-success">Active</a>
                                    @else
                                        <a href="{{ route('upazila.status',$upazila->id) }}" class="btn btn-danger">DeActive</a>
                                    @endif
                                </td> --}}

                                <td>
                                    <button data-id="{{ $upazila->id }}" class="btn btn-sm status-toggle-btn {{ $upazila->is_active ? 'btn-success' : 'btn-danger' }}">
                                        {{ $upazila->is_active ? 'Active' : 'DeActive' }}
                                    </button>
                                </td>


                                <td>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm editUpazila"
                                        data-id="{{ $upazila->id }}"
                                        data-name="{{ $upazila->upazila_name }}"
                                        data-district="{{ $upazila->district_id }}"
                                        data-shipping="{{ $upazila->shipping_cost }}"
                                        data-status="{{ $upazila->is_active }}">
                                            <i class="material-icons text-white">edit</i>
                                    </a>


                                    <form class="d-inline-block" action="{{ route('upazila.destroy',$upazila->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="material-icons">delete</i></button>
                                    </form>

                                </td>
                            </tr>

                            @endforeach

                            
                        </tbody>
                    </table>
                </div>

                <!--Add upazila Bootstrap Modal -->
                @include('admin.layouts.pages.upazila.create')


                <!-- Edit Upazila Modal -->
               @include('admin.layouts.pages.upazila.edit')



            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<!-- Jquery DataTable Plugin Js -->
 <script src="{{ asset('backend') }}/assets/bundles/datatablescripts.bundle.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>


<!-- Custom Js -->
<script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>
<script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


 <!-- Script For status change -->
<script>
    const upazilaStatusRoute = "{{ route('upazila.status') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('backend') }}/assets/js/upazila.js"></script>





@endpush
