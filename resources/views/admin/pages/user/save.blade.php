@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users List</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ isset($user) ? 'Edit User' : 'Create User' }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">{{ isset($user) ? 'Edit User' : 'Create New User' }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{ isset($user) ? 'Edit User Details' : 'Enter User Details' }}</h5>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> Back to Users
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ isset($user) ? route('admin.user.update', $user->id) : route('admin.user.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name', $user->name ?? '') }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', $user->email ?? '') }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        {{ isset($user) ? 'New Password (leave blank to keep current)' : 'Password' }}
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           {{ isset($user) ? '' : 'required' }}>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" 
                                           name="password_confirmation" {{ isset($user) ? '' : 'required' }}>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label">User Role</label>
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="">Select Role</option>
                                        <option value="user" {{ (old('role', $user->role ?? '') == 'user') ? 'selected' : '' }}>
                                            Regular User
                                        </option>
                                        <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>
                                            Administrator
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            @if(isset($user))
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="active" class="form-label">Status</label>
                                    <select class="form-select" id="active" name="active">
                                        <option value="1" {{ (old('active', $user->active) == 1) ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="0" {{ (old('active', $user->active) == 0) ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> {{ isset($user) ? 'Update User' : 'Create User' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 