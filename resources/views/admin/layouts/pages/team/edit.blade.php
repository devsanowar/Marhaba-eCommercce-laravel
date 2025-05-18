@extends('admin.layouts.app')
@section('title', 'Edit Team')
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
                        <h4>Edit Team Member <span><a href="{{ route('team.index') }}" class="btn btn-primary right">All Team Members</a></span></h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('team.update',$team->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="team_name_id" class="form-label">Name</label>
                                <input type="text" id="team_name_id" name="name"
                                    class="form-control" placeholder="Enter name" value="{{ $team->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="team_designation" class="form-label">Designation</label>
                                <input type="text" id="team_designation" name="position"
                                    class="form-control" placeholder="Enter designtaion" value="{{ $team->position }}">
                            </div>

                            <div class="mb-3">
                                <label for="team_designation" class="form-label">Image* (Image Size 350 X 400)- Max:80kb</label>
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="file" class="form-control" id="customFile" name="image">
                                </div>
                                <img class="mt-2" src="{{ asset($team->image) }}" alt="image" width="60">
                            </div>

                            <div class="mb-3">
                                <label for="team_designation" class="form-label">Status</label>
                                <select name="is_active" class="form-control show-tick">
                                    <option @if($team->is_active == 1 ) selected @endif value="1">Active</option>
                                    <option @if($team->is_active == 0 ) selected @endif value="0">DeActive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
