@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Chapter mananger</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @isset($story)
            <div class="col-12">
                <div class="mb-2">
                    <a class="btn btn-secondary" href="{{ route('admin.story.index') }}">Back</a>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Chapters List of "<a
                                href="{{ route('admin.story.edit', $story->id) }}">{{ $story->title }}</a>"</h5>
                        <a href="{{ route('admin.story.create_chapter', $story->id) }}" class="btn btn-sm btn-primary">
                            <i class="ti ti-plus"></i> Add Chapter
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px;" class="text-center"><i class="ti ti-arrows-sort"></i></th>
                                    <th>Chapter Title</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @foreach ($story->chapters->sortBy('index') as $index => $chap)
                                    <tr class="ui-state-default" data-id="{{ $chap->id }}">
                                        <td class="text-center cursor-move">
                                            <i class="ti ti-grip-vertical text-secondary"></i>
                                        </td>
                                        <td>
                                            <strong>Chapter {{ $index + 1 }}: </strong>{{ $chap->title }}
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.story.edit_chapter', [$story->id, $chap->id]) }}"
                                                class="btn btn-sm btn-outline-success me-1" data-bs-toggle="tooltip" title="Edit">
                                                <i class="ti ti-edit-circle"></i>
                                            </a>
                                            <form action="{{ route('admin.story.destroy_chapter', [$story->id, $chap->id]) }}"
                                                method="POST" class="d-inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this chapter?')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip"
                                                    title="Delete">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endisset

    </div>
    @isset($story)
        <script>
            $(function () {
                $("#sortable").sortable({
                    placeholder: "ui-sortable-placeholder",
                    handle: ".cursor-move",
                    update: function (event, ui) {
                        const chapterIds = $(this).sortable('toArray', {
                            attribute: 'data-id'
                        });

                        $.ajax({
                            url: `{{ route('admin.story.update_chapter_order', $story->id) }}`,
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                chapterIds: chapterIds
                            },
                            success: function (response) {
                                if (response.success) {
                                    $("#sortable tr").each(function (index) {
                                        const chapterTitle = $(this).find(
                                            'td:eq(1) strong');
                                        const currentText = chapterTitle.text();
                                        const newText = currentText.replace(
                                            /Chapter \d+:/, 'Chapter ' + (index + 1) +
                                        ':');
                                        chapterTitle.text(newText);
                                        $(this).addClass('row-highlight');
                                        setTimeout(() => $(this).removeClass(
                                            'row-highlight'), 800);
                                    });

                                    toastr.success("Chapter order has been updated!");
                                } else {
                                    toastr.error("Error updating order. Please try again.");
                                }
                            },
                            error: function () {
                                toastr.error(
                                    "Connection error. Please check your network.");
                            }
                        });
                    }
                });
            });
        </script>
    @endisset
    <style>
        .cursor-move {
            cursor: move;
        }

        .ui-sortable-placeholder {
            background: #f8f9fa;
            border: 2px dashed #008080;
            visibility: visible !important;
            height: 3em;
        }

        .row-highlight {
            animation: fadeHighlight 0.8s ease-in-out;
        }

        @keyframes fadeHighlight {
            from {
                background-color: #d1e7dd;
            }

            to {
                background-color: transparent;
            }
        }
    </style>
@endsection