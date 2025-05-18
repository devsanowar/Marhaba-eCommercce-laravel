@extends('admin.layouts.app')
@section('title')
   Show Social Work
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
                <div class="col-md-12 col-lg-12 col-sm-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            All social work images
                        </div>
                        <div class="card-body">
                            <div class="image-grid"
                            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 15px;">
                            @foreach ($socialWorkImages as $socialWorkImage)
                                <div class="image-item" data-id="{{ $socialWorkImage->id }}">
                                    <div style="position: relative;">
                                        <img src="{{ asset($socialWorkImage->images) }}" alt="Image" width="150"
                                            class="img-thumbnail">
                                        <button class="btn btn-danger btn-sm delete-image"
                                            style="position: absolute; top: 5px; right: 5px;">
                                            &times;
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@push('scripts')


    <script>
        $(document).on('click', '.delete-image', function(e) {
            e.preventDefault();

            let button = $(this);
            let imageItem = button.closest('.image-item');
            let imageId = imageItem.data('id');

            if (confirm('Are you sure you want to delete this image?')) {
                $.ajax({
                    url: "{{ route('social_work.image.delete', ['id' => '__id__']) }}".replace('__id__',
                        imageId),
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            imageItem.remove();
                            toastr.success(response.message);
                        } else {
                            toastr.error('Failed to delete image.');
                        }
                    },
                    error: function() {
                        toastr.error('Something went wrong.');
                    }
                });
            }
        });
    </script>
@endpush
