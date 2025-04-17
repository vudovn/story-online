@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.story.index') }}">Story Management</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ $title ?? 'No title' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-end">
                    <a href="{{ route('admin.story.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="card-body">
                    @include('admin.components.ui.alert')
                    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label">Chapter Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $chapter->title ?? old('title') }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="content" rows="10"
                                    class="form-control ck-editor">{{ $chapter->content ?? old('content') }}</textarea>
                            </div>
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