@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item"><a href="javascript: void(0)">DataTable</a></li> --}}
                        <li class="breadcrumb-item" aria-current="page">Categories List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-end">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create Category</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Stories Count</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->stories_count }}</td>
                                    <td>
                                        <div class="form-check form-switch mb-2">
                                            <input type="checkbox" class="update_status form-check-input input-primary"
                                                {{ $category->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete?')">
                                            @csrf
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <a href="{{ route('admin.category.edit', $category->id) }}"
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
                var categoryId = $(this).closest('tr').find('td:first')
                    .text();
                $.ajax({
                    url: "{{ route('admin.category.update_status') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: categoryId,
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
        });
    </script>
@endsection
