@extends('admin.layouts.app')
@section('title')
    Social Work Page
@endsection
@push('styles')
    <style>
        .form-group .form-control {
            padding-left: 10px;
        }

        .img-preview-wrapper {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .img-preview {
            max-width: 150px;
            max-height: 150px;
            border-radius: 10px;
            border: 1px solid #ccc;
            object-fit: cover;
        }

        .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 14px;
            width: 24px;
            height: 24px;
            cursor: pointer;
            z-index: 10;
        }
    </style>
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                <div>
                    <h4 class="text-center mb-0">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('social_work_all_images') }}"
                                class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                                All Social Work Images
                            </a>

                        </div>
                    </h4>
                </div>
            </div>
        </div>
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> Social Work </h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" id="imageUploadForm" enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>About Image</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input class="form-control" type="file" id="imageInput" name="images[]" multiple
                                            accept="image/*">
                                    </div>
                                    <div id="previewContainer" class="d-flex flex-wrap"></div>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect">SAVE
                                    <span id="formSpinner" class="spinner-border spinner-border-sm text-light ms-2 d-none"
                                        role="status"></span>
                                </button>


                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- #END# Horizontal Layout -->
    </div>



@endsection

@push('scripts')
    <script>
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');

        let dt = new DataTransfer();

        imageInput.addEventListener('change', function() {
            // Clear old previews
            previewContainer.innerHTML = '';

            // Reset DataTransfer and rebuild with new selection
            dt = new DataTransfer();

            Array.from(this.files).forEach((file, index) => {
                dt.items.add(file); // Add file to DataTransfer
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('img-preview-wrapper');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-preview');

                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.classList.add('remove-btn');
                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        dt.items.remove(index); // Remove from DataTransfer
                        imageInput.files = dt.files; // Reset input with new files
                        renderPreviews(); // Re-render
                    });

                    wrapper.appendChild(removeBtn);
                    wrapper.appendChild(img);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });

            imageInput.files = dt.files; // Set files to input
        });

        function renderPreviews() {
            previewContainer.innerHTML = '';
            Array.from(dt.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('img-preview-wrapper');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-preview');

                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.classList.add('remove-btn');
                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        dt.items.remove(index);
                        imageInput.files = dt.files;
                        renderPreviews();
                    });

                    wrapper.appendChild(removeBtn);
                    wrapper.appendChild(img);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

    <script>
        $('#imageUploadForm').on('submit', function(e) {
            e.preventDefault();

            // Show Spinner
            $('#formSpinner').removeClass('d-none');

            // Clear preview images
            $('#previewContainer').empty();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('social_work.images') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Hide Spinner
                    $('#formSpinner').addClass('d-none');

                    if (response.success) {
                        toastr.success('Images uploaded successfully!');

                        // Reset form fields
                        $('#imageUploadForm')[0].reset();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Something went wrong!');

                    // Hide Spinner
                    $('#formSpinner').addClass('d-none');
                }
            });
        });
    </script>


@endpush
