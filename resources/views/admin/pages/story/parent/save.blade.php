@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Add New Story</li>
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
                            <div class="col-9">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Story Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $story->title ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        value="{{ old('author', $story->author ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Story Categories</label>
                                    <select name="category[]" id="category" class="form-select js-choice" multiple>
                                        <option value="">Select categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ in_array($category->id, old('category', $categoryIds ?? [])) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control ck-editor" id="description" name="description"
                                        rows="12">{{ old('description', $story->description ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-4">
                                    <div class="thumbnail img-cover image-target">
                                        <img src="{{ old('thumbnail', $story->thumbnail ?? 'https://placehold.co/600x600?text=Story%20Cover') }}"
                                            width="100%" class="img-thumbnail img-fluid" alt="Cover Image">
                                    </div>
                                    <input type="hidden" name="thumbnail"
                                        value="{{ old('thumbnail', $story->thumbnail ?? '') }}">
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="0" {{ old('status', $story->status ?? '') == 0 ? 'selected' : '' }}>
                                            Private
                                        </option>
                                        <option value="1" {{ old('status', $story->status ?? '') == 1 ? 'selected' : '' }}>
                                            Public
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="form-label">Story Status</label>
                                    <select class="form-select" id="status_story" name="status_story" required>
                                        <option value="Completed" {{ old('status_story', $story->status_story ?? '') == 1 ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                        <option value="Ongoing" {{ old('status_story', $story->status_story ?? '') == 0 ? 'selected' : '' }}>
                                            Ongoing
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="feature" class="form-label">Featured Story</label>
                                    <select class="form-select" id="feature" name="feature" required>
                                        <option value="1" {{ old('feature', $story->feature ?? '') == 1 ? 'selected' : '' }}>
                                            Featured
                                        </option>
                                        <option value="0" {{ old('feature', $story->feature ?? '') == 0 ? 'selected' : '' }}>
                                            Not Featured
                                        </option>
                                    </select>
                                </div>
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