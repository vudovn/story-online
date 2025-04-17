<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Story;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\ReadingHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic counts
        $userCount = User::count();
        $storyCount = Story::count();
        $categoryCount = Category::count();
        $chapterCount = Chapter::count();

        // Active and inactive users
        $activeUsers = User::where('active', 1)->count();
        $inactiveUsers = User::where('active', 0)->count();

        // Stories by status
        $completedStories = Story::where('status_story', 'Completed')->count();
        $ongoingStories = Story::where('status_story', '!=', 'Completed')->count();

        // Hot stories
        $hotStories = Story::where('feature', 1)->count();

        // Total views
        $totalViews = Story::sum('view');

        // Top 10 most viewed stories
        $topStories = Story::orderBy('view', 'desc')->take(10)->get();

        // Most recent stories
        $recentStories = Story::orderBy('created_at', 'desc')->take(5)->get();

        // Most recent users
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        // Recent reading activity
        $recentActivity = ReadingHistory::with(['user', 'story', 'chapter'])
            ->orderBy('timestamp', 'desc')
            ->take(10)
            ->get();

        // Stories read count per day for the last 7 days
        $lastWeekActivity = ReadingHistory::select(DB::raw('DATE(timestamp) as date'), DB::raw('count(*) as count'))
            ->where('timestamp', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Fill in missing days in the last week
        $activityData = [];
        $labels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::now()->subDays($i)->format('D');
            $activityData[] = $lastWeekActivity[$date] ?? 0;
        }

        // Registration trend for the last 7 days
        $registrationTrend = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        $registrationData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $registrationData[] = $registrationTrend[$date] ?? 0;
        }

        // Categories with story counts
        $categories = Category::withCount('stories')->orderBy('stories_count', 'desc')->take(5)->get();

        return view('admin.pages.dashboard.index', compact(
            'userCount',
            'storyCount',
            'categoryCount',
            'chapterCount',
            'activeUsers',
            'inactiveUsers',
            'completedStories',
            'ongoingStories',
            'hotStories',
            'totalViews',
            'topStories',
            'recentStories',
            'recentUsers',
            'recentActivity',
            'labels',
            'activityData',
            'registrationData',
            'categories'
        ));
    }
}
