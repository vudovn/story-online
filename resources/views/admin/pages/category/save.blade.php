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
                    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="card-body">
                    @include('admin.components.ui.alert')
                    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input value="{{ old('name', $category->name ?? '') }}" type="text" class="form-control"
                                id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option {{ old('status', $category->status ?? '') == 1 ? 'selected' : '' }} value="1">
                                    Active</option>
                                <option {{ old('status', $category->status ?? '') == 0 ? 'selected' : '' }} value="0">
                                    Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="3">{{ old('name', $category->name ?? '') }}</textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection