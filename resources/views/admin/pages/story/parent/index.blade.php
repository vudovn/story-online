@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Stories List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-end">
                    <a href="{{ route('admin.story.create') }}" class="btn btn-primary">Add Story</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Latest Chapter</th>
                                <th>Author</th>
                                <th>Hot Story</th>
                                <th>Story Status</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stories as $key => $story)
                                <tr>
                                    <td><img src="{{ $story->thumbnail }}" width="70" class="rounded"
                                            alt="{{ $story->name }}"></td>
                                    <td>{{ $story->title }}</td>
                                    <td>{{ $story->new_chapter ? "Chapter $story->new_chapter" : 'No chapters yet' }}</td>
                                    <td>
                                        <span class="badge bg-light-primary">{{ $story->author }}</span>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch mb-2">
                                            <input type="checkbox" class="update_feature form-check-input input-primary"
                                                data-id="{{ $story->id }}" {{ $story->feature == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <select name="status_story" data-id="{{ $story->id }}"
                                            class="update_status_story form-select form-select-sm" style="width: 70%">
                                            <option {{ $story->status_story == 'Completed' ? 'selected' : '' }}
                                                value="Completed">Completed</option>
                                            <option {{ $story->status_story == 'Ongoing' ? 'selected' : '' }}
                                                value="Ongoing">Ongoing</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch mb-2">
                                            <input type="checkbox" data-id="{{ $story->id }}"
                                                class="update_status form-check-input input-primary"
                                                {{ $story->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.story.destroy', $story->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete?')">
                                            @csrf
                                            <a data-bs-toggle="tooltip" title="Chapter"  href="{{ route('admin.story.index_chapter', $story->id) }}"
                                                class="avtar avtar-xs btn-link-warning btn-pc-default">
                                                <i class="ti ti-eye f-18"></i>
                                            </a>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <a href="{{ route('admin.story.edit', $story->id) }}"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a>
                                            </li>
                                            <button class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                    class="ti ti-trash f-18"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".update_status").change(function() {
                var status = $(this).is(':checked') ? 1 : 0;
                var data_id = $(this).data('id')
                $.ajax({
                    url: "{{ route('admin.story.update_status') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: data_id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success("Status updated successfully.")
                        } else {
                            toastr.error("Error occurred while updating status.")
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Error occurred while updating status!")
                    }
                });
            });

            $(".update_feature").change(function() {
                var status = $(this).is(':checked') ? 1 : 0;
                var data_id = $(this).data('id')
                $.ajax({
                    url: "{{ route('admin.story.update_feature') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: data_id,
                        feature: status
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success("Hot story status updated successfully.")
                        } else {
                            toastr.error("Error occurred while updating hot story status.")
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Error occurred while updating hot story status!")
                    }
                });
            });

            $(".update_status_story").change(function() {
                var status = $(this).val();
                var data_id = $(this).data('id')
                $.ajax({
                    url: "{{ route('admin.story.update_status_story') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: data_id,
                        status_story: status
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success("Story status updated successfully.")
                        } else {
                            toastr.error("Error occurred while updating story status.")
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Error occurred while updating story status!")
                    }
                });
            });
        });
    </script>
@endsection
