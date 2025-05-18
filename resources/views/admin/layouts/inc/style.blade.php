
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/morrisjs/morris.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/main.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/custom.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/color_skins.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/toastr.css">
<style>


    .input-group .input-group-addon {
        padding-left: 10px;
    }

    .input-group .input-group-addon + .form-line {
        padding-left: 35px;
    }



    .form-group .form-control {
	    padding-left: 10px;
    }


    .bootstrap-select.btn-group.show-tick > .btn {
        padding-left: 10px;
        color: #393939;
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

    .bootstrap-select.btn-group.show-tick > .btn {
        width: 100%;
    }




    .btn:not(.btn-link):not(.btn-circle) i {
	font-size: 16px;
}

</style>
@stack('styles')
