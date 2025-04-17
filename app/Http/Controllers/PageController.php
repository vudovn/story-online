<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Story;
use Illuminate\Http\Request;
use App\Repositories\StoryRepository;

class PageController extends Controller
{
    protected $storyRepository;
    public function __construct(StoryRepository $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }
    public function index()
    {
        $title = "Home";
        $hot_story = $this->storyRepository->get_hot_story()->take(6);
        $new_story = $this->storyRepository->get_new_story()->take(6);
        $end_story = $this->storyRepository->get_end_story()->take(6);

        $userId = \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::id() : null;
        $recommended_stories = $this->storyRepository->get_recommended_stories($userId);

        return view("client.pages.home", compact(
            "title",
            "hot_story",
            "new_story",
            "end_story",
            "recommended_stories"
        ));
    }

    public function hot_stories()
    {
        $title = "Hot Stories";
        $stories = Story::with('categories')
            ->where('feature', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return view("client.pages.story_list", compact(
            "title",
            "stories"
        ));
    }

    public function latest_stories()
    {
        $title = "Latest Stories";
        $stories = Story::with('categories')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return view("client.pages.story_list", compact(
            "title",
            "stories"
        ));
    }

    public function completed_stories()
    {
        $title = "Completed Stories";
        $stories = Story::with('categories')
            ->where('status_story', 'Completed')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return view("client.pages.story_list", compact(
            "title",
            "stories"
        ));
    }

    public function story($slug)
    {
        $story = $this->storyRepository->get_story_by_slug($slug);
        $top_view = $this->storyRepository->get_top_view();
        if (!$story) {
            return redirect()->route('client.index');
        }
        $title = $story->title;
        $chapters = $story->chapters()->orderBy('index', 'asc')->paginate(30);
        $story->increment('view');
        return view("client.pages.story", compact(
            "title",
            "story",
            "chapters",
            "top_view",
        ));
    }

    public function chapter($slug_story, $index_chapter)
    {
        $index_chapter = str_replace("chuong-", "", $index_chapter);
        $chapter = $this->storyRepository->get_chapter_by_slug_chapter($slug_story, $index_chapter);

        // Redirect to story page if chapter not found
        if (!$chapter) {
            return redirect()->route('client.story', $slug_story)
                ->with('error', 'Chapter not found');
        }

        $title = $chapter->story->title . " - Chapter " . $chapter->index . ": " . $chapter->title;
        $chapters = $chapter->story->chapters()->orderBy('index', 'asc')->get();
        $previous_chapter = $chapters->where('index', '<', $chapter->index)->last();
        $next_chapter = $chapters->where('index', '>', $chapter->index)->first();

        // Save reading history for authenticated users
        if (\Illuminate\Support\Facades\Auth::check()) {
            try {
                // Create or update reading history
                \App\Models\ReadingHistory::updateOrCreate(
                    [
                        'user_id' => \Illuminate\Support\Facades\Auth::id(),
                        'story_id' => $chapter->story->id,
                    ],
                    [
                        'chapter_id' => $chapter->id,
                        'timestamp' => now(),
                    ]
                );
            } catch (\Exception $e) {
                // Log error but don't disrupt user experience
                \Illuminate\Support\Facades\Log::error('Failed to save reading history: ' . $e->getMessage());
            }
        }

        return view("client.pages.chapter", compact(
            "chapter",
            "title",
            "chapters",
            "previous_chapter",
            "next_chapter",
        ));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            return redirect()->route('client.index')->with('error', 'Category does not exist');
        }
        $title = $category->name;

        // Add sorting functionality
        $sort = request()->get('sort', 'updated_at');

        $query = $category->stories();

        switch ($sort) {
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'view':
                $query->orderBy('view', 'desc');
                break;
            default:
                $query->orderBy('updated_at', 'desc');
                break;
        }

        $stories = $query->paginate(16);

        return view("client.pages.category", compact(
            "title",
            "category",
            "stories",
        ));
    }
    public function search(Request $request)
    {
        $query = $request->input('key_word');
        $stories = $this->storyRepository->search($query);

        return view('client.pages.search', compact('stories', 'query'));
    }
}
