@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Users List</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Users Management</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    
    @php
        use Illuminate\Support\Facades\Auth;
    @endphp
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>All Users</h5>
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> Add New User
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="badge bg-light-danger">Admin</span>
                                        @else
                                            <span class="badge bg-light-primary">User</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input toggle-status" 
                                                   data-id="{{ $user->id }}" 
                                                   {{ $user->active ? 'checked' : '' }}
                                                   {{ $user->id == Auth::id() ? 'disabled' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.user.show', $user->id) }}" 
                                               class="btn btn-icon btn-sm btn-info me-2" 
                                               data-bs-toggle="tooltip" title="View User">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            
                                            <a href="{{ route('admin.user.edit', $user->id) }}" 
                                               class="btn btn-icon btn-sm btn-success me-2" 
                                               data-bs-toggle="tooltip" title="Edit User">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            
                                            @if($user->id != Auth::id())
                                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    <button type="button" class="btn btn-icon btn-sm btn-danger delete-btn" 
                                                            data-bs-toggle="tooltip" title="Delete User">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        $(document).ready(function() {
            
            // Handle status toggle
            $('.toggle-status').on('change', function() {
                const userId = $(this).data('id');
                const status = $(this).prop('checked') ? 1 : 0;
                
                $.ajax({
                    url: '{{ route('admin.user.update_status') }}',
                    type: 'POST',
                    data: {
                        id: userId,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('User status updated successfully');
                        }
                    },
                    error: function() {
                        toastr.error('Error updating user status');
                        // Revert the toggle
                        $(this).prop('checked', !status);
                    }
                });
            });
            
            // Handle delete button
            $('.delete-btn').on('click', function() {
                const deleteForm = $(this).closest('form');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.submit();
                    }
                });
            });
        });
    </script>
    @endpush
@endsection