@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users List</a></li>
                        <li class="breadcrumb-item" aria-current="page">User Details</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">User Profile: {{ $user->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="user-avatar mb-3">
                            <span class="avatar bg-primary text-white rounded-circle"
                                style="font-size: 24px; width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="text-muted">
                            @if($user->role == 'admin')
                                <span class="badge bg-danger">Administrator</span>
                            @else
                                <span class="badge bg-primary">Regular User</span>
                            @endif
                        </p>
                    </div>

                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-muted mb-1">Status</h6>
                                <p>
                                    @if($user->active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-6">
                                <h6 class="text-muted mb-1">Member Since</h6>
                                <p>{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary w-100">
                                <i class="ti ti-edit"></i> Edit
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary w-100">
                                <i class="ti ti-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>User Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="mb-0 text-muted">Full Name</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="mb-0 text-muted">Email</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="mb-0 text-muted">Role</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">{{ ucfirst($user->role) }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="mb-0 text-muted">Created At</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">{{ $user->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="mb-0 text-muted">Last Updated</h6>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">{{ $user->updated_at->format('F d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Reading History</h5>
                </div>
                <div class="card-body">
                    @if($user->readingHistory->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Story</th>
                                        <th>Last Chapter</th>
                                        <th>Last Read</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->readingHistory as $history)
                                        <tr>
                                            <td>{{ $history->story->title }}</td>
                                            <td>Chapter {{ $history->chapter->index }}: {{ $history->chapter->title }}</td>
                                            <td>{{ $history->timestamp->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('client.chapter', [$history->story->slug, 'chuong-' . $history->chapter->index]) }}"
                                                    class="btn btn-sm btn-info" target="_blank">
                                                    <i class="ti ti-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="ti ti-book"></i> This user has not read any stories yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection