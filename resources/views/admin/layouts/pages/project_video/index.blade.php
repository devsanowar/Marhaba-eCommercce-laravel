@extends('admin.layouts.app')
@section('title', 'Project Video')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> All Videos
                            <span>
                                <button type="button" class="btn btn-primary right" data-bs-toggle="modal"
                                    data-bs-target="#addCategoryModal">
                                    Add Project Video
                                </button>
                            </span>
                        </h4>
                    </div>


                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Porject Video Url</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($project_videos as $key => $project_video)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $project_video->video_url }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning editProjectVideoBtn"
                                                data-id="{{ $project_video->id }}"
                                                data-video_url="{{ $project_video->video_url }}">
                                                <i class="material-icons text-white">edit</i>
                                            </a>

                                            <form class="d-inline-block"
                                                action="{{ route('project_video.destroy', $project_video->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-raised bg-pink waves-effect show_confirm"> <i
                                                        class="material-icons">delete</i> </button>
                                            </form>
                                        </td>

                                    <tr>
                                    @empty
                                        <table>
                                            <thead>
                                                <tr>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    Project Video Not Found! :) Please Add Project Category. Thank you
                                                </tr>
                                            </tbody>
                                        </table>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <!--Add Category Modal -->
                    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Project Video</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                            class="zmdi zmdi-close"></i> </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('project_video.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="video_url_id" class="form-label">Project Video Url</label>
                                            <input type="text" id="video_url_id" name="video_url" class="form-control"
                                                placeholder="Enter Youtube Video link">
                                        </div>
                                        <button type="submit" class="btn btn-primary">SAVE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Edit Project Video Modal -->
                    <div class="modal fade" id="editProjectVideoModal" tabindex="-1"
                        aria-labelledby="editProjectVideoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="editProjectVideoForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProjectVideoLabel">Edit Project Video</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"><i
                                            class="zmdi zmdi-close"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="edit_video_id">
                                        <div class="mb-3">
                                            <label for="video_url" class="form-label">Video URL</label>
                                            <input type="text" name="video_url" class="form-control" id="edit_video_url">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!--End Edit Category Modal -->

                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>


    <script>
        $(document).on('click', '.editProjectVideoBtn', function() {
            let id = $(this).data('id');
            let video_url = $(this).data('video_url');

            $('#edit_video_id').val(id);
            $('#edit_video_url').val(video_url);

            // Set form action using route helper with placeholder
            let actionUrl = '{{ route("project_video.update", ":id") }}';
            actionUrl = actionUrl.replace(':id', id);
            $('#editProjectVideoForm').attr('action', actionUrl);

            // Show the modal
            $('#editProjectVideoModal').modal('show');
        });
    </script>





    <script>
        $('.show_confirm').click(function(event) {
            let form = $(this).closest('form');
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });

        });
    </script>

@endpush
