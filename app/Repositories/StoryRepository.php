<?php
namespace App\Repositories;
use App\Models\Story;
use App\Repositories\Interfaces\StoryRepositotyInterface;
use App\Models\ReadingHistory;

class StoryRepository implements StoryRepositotyInterface
{
    public function get_hot_story()
    {
        return Story::where('status', 1)
            ->where('feature', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function get_new_story()
    {
        return Story::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function get_end_story()
    {
        return Story::where('status', 1)
            ->where('status_story', "Completed")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function get_story_by_slug($slug)
    {
        return Story::with('categories')->where('slug', $slug)->first();
    }

    public function get_top_view()
    {
        return Story::where('status', 1)
            ->orderBy('view', 'desc')
            ->take(10)
            ->get();
    }

    public function get_chapter_by_slug_chapter($slug_story, $index_chapter)
    {
        return Story::with('chapters')->where('slug', $slug_story)->first()->chapters()->where('index', $index_chapter)->first();
    }

    public function search($query)
    {
        return Story::where('status', 1)->where('title', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function get_recommended_stories($userId, $limit = 8)
    {
        if (!$userId) {
            return $this->get_hot_story()->take($limit);
        }

        $userReadHistoryStories = ReadingHistory::where('user_id', $userId)
            ->with('story.categories')
            ->orderBy('timestamp', 'desc')
            ->take(10)
            ->get();

        if ($userReadHistoryStories->isEmpty()) {
            return $this->get_hot_story()->take($limit);
        }

        $categoryIds = [];
        foreach ($userReadHistoryStories as $history) {
            if ($history->story && $history->story->categories) {
                foreach ($history->story->categories as $category) {
                    $categoryIds[$category->id] = ($categoryIds[$category->id] ?? 0) + 1;
                }
            }
        }

        arsort($categoryIds);
        $categoryIds = array_keys($categoryIds);

        $readStoryIds = $userReadHistoryStories->pluck('story_id')->toArray();

        return Story::where('status', 1)
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', array_slice($categoryIds, 0, 3));
            })
            ->whereNotIn('id', $readStoryIds)
            ->orderBy('view', 'desc')
            ->take($limit)
            ->get();
    }
}
