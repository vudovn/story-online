<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ChapterResource;
use App\Models\Story;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\StoryResource;
class ApiController extends Controller
{
    /**
     * Get all stories
     */
    public function get_story()
    {
        $stories = Story::with('categories')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => StoryResource::collection($stories),
        ]);
    }

    /**
     * Get hot stories
     */
    public function get_hot_story()
    {
        $hot_stories = Story::with('categories')
            ->where('feature', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => StoryResource::collection($hot_stories),
        ]);
    }

    /**
     * Get completed stories
     */
    public function get_completed_story()
    {
        $completed_stories = Story::with('categories')
            ->where('status_story', 'Completed')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => StoryResource::collection($completed_stories)
        ]);
    }

    /**
     * Get story by slug
     */
    public function get_story_by_slug($slug)
    {
        $story = Story::with(['categories', 'chapters'])
            ->where('slug', $slug)
            ->first();
        if (!$story) {
            return response()->json([
                'status' => false,
                'message' => 'Story not found'
            ], 404);
        }
        $story->chapters->transform(function ($chapter) use ($story) {
            $chapter_url = "chuong-$chapter->index";
            $chapter->url = route('client.chapter', [$story->slug, $chapter_url]);
            return $chapter;
        });
        return response()->json([
            'status' => true,
            'data' => [
                'id' => $story->id,
                'title' => $story->title,
                'status_story' => $story->status_story,
                'description' => $story->description,
                'url' => route('client.story', $story->slug),
                'categories' => CategoryResource::collection($story->categories),
                'chappters' => ChapterResource::collection($story->chapters)
            ]
        ]);
    }


    /**
     * Get all categories
     */
    public function get_category()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'data' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Get category by slug with stories
     */
    public function get_category_by_slug($slug)
    {
        $category = Category::with(['stories'])->where('slug', $slug)->first();
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'id' => $category->id,
                'title' => $category->name,
                'stories' => StoryResource::collection($category->stories),
            ]
        ]);
    }



    public function get_search(Request $request)
    {
        $search = $request->get('keyword');
        $ketqua = Story::where('status', 1)->where('title', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'status' => true,
            'data' => StoryResource::collection($ketqua)
        ]);
    }
}
