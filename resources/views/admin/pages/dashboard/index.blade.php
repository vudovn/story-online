@extends('admin.layout')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Stats -->
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-lg bg-light-primary">
                                <i class="ti ti-users f-20 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Total Users</h6>
                            <small class="text-muted">{{ $activeUsers }} active / {{ $inactiveUsers }} inactive</small>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-primary mb-0">{{ $userCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-lg bg-light-success">
                                <i class="ti ti-books f-20 text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Stories</h6>
                            <small class="text-muted">{{ $completedStories }} completed / {{ $ongoingStories }}
                                ongoing</small>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-success mb-0">{{ $storyCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-lg bg-light-warning">
                                <i class="ti ti-layers f-20 text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Categories</h6>
                            <small class="text-muted">Story categories</small>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-warning mb-0">{{ $categoryCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-lg bg-light-danger">
                                <i class="ti ti-flame f-20 text-danger"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Hot Stories</h6>
                            <small class="text-muted">{{ number_format($totalViews) }} total views</small>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-danger mb-0">{{ $hotStories }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- User Registration Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>User Registrations (Last 7 Days)</h5>
                </div>
                <div class="card-body">
                    <div id="user-registration-chart" style="height: 320px;"></div>
                </div>
            </div>
        </div>

        <!-- Reading Activity Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Reading Activity (Last 7 Days)</h5>
                </div>
                <div class="card-body">
                    <div id="reading-activity-chart" style="height: 320px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Stories & Categories -->
    <div class="row">
        <!-- Top Stories -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Top Stories by Views</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topStories as $index => $story)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($story->thumbnail) }}" alt="{{ $story->title }}"
                                                    class="img-fluid wid-30 rounded me-2">
                                                <div>
                                                    <h6 class="mb-0">{{ $story->title }}</h6>
                                                    <small>{{ count($story->chapters) }} chapters</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $story->author }}</td>
                                        <td>
                                            @if($story->status_story == 'Completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-warning">Ongoing</span>
                                            @endif

                                            @if($story->feature == 1)
                                                <span class="badge bg-danger">Hot</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($story->view) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Categories -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Top Categories</h5>
                </div>
                <div class="card-body">
                    <div id="category-chart" style="height: 300px;"></div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0">{{ $category->name }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-end">{{ $category->stories_count }} stories</h6>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <!-- Recent Users -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Users</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($recentUsers as $user)
                            <li class="list-group-item px-0">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s bg-light-primary">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div>
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary btn-sm">View All Users</a>
                </div>
            </div>
        </div>

        <!-- Recent Reading Activity -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Reading Activity</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($recentActivity as $activity)
                            <li class="list-group-item px-0">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s bg-light-success">
                                            {{ strtoupper(substr($activity->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $activity->user->name ?? 'Unknown User' }}</h6>
                                        <small class="text-muted">
                                            Read
                                            <a href="{{ route('client.chapter', [$activity->story->slug, 'chuong-' . $activity->chapter->index]) }}"
                                                target="_blank">
                                                Chapter {{ $activity->chapter->index }}: {{ $activity->chapter->title }}
                                            </a>
                                            of
                                            <a href="{{ route('client.story', $activity->story->slug) }}" target="_blank">
                                                {{ $activity->story->title }}
                                            </a>
                                        </small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <small
                                            class="text-muted">{{ Carbon\Carbon::parse($activity->timestamp)->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pages.dashboard.components.scripts')
@endsection