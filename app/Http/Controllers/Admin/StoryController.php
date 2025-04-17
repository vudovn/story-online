<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Category;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Stories List";
        $stories = Story::all();
        return view("admin.pages.story.parent.index", compact(
            "title",
            "stories"
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Story";
        $categories = Category::all();
        $route = route('admin.story.store');
        return view("admin.pages.story.parent.save", compact(
            "title",
            "route",
            "categories"
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "title" => "required|string|unique:stories,title",
            ],
            [
                "title.required" => "Please enter story title",
                "title.string" => "Invalid story title",
                "title.unique" => "Story title already exists",
            ]
        );
        $ketqua = transaction(function () use ($request) {
            $slug = str_slug($request->title);
            $request->merge(["slug" => $slug]);
            $result = Story::create($request->all());
            $addCategory = $result->categories()->sync($request->category);
            return $result;
        });
        if ($ketqua) {
            return redirect()->route("admin.story.index_chapter", $ketqua->id)->with("success", "Story added successfully");
        } else {
            return redirect()->back()->with("error", "Failed to add story");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $story = Story::find($id);
        $title = "Edit Story - " . $story->title;
        if (!$story) {
            return redirect()->back()->with("error", "Story does not exist");
        }
        $categories = Category::all();
        $categoryIds = $story->categories->pluck("id")->toArray();
        $route = route('admin.story.update', $story->id);
        return view("admin.pages.story.parent.save", compact(
            "title",
            "story",
            "route",
            "categories",
            "categoryIds"
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                "title" => "required|string|unique:stories,title,$id,id",
            ]
        );
        $story = Story::findOrFail($id);
        if (!$story) {
            return redirect()->route("admin.story.index")->with("error", "Story does not exist");
        }
        $ketqua = transaction(function () use ($story, $request) {
            $story->slug = str_slug($request->title);
            $story->update($request->all());
            $story->categories()->sync($request->category);
            return true;
        });
        if ($ketqua) {
            return redirect()->back()->with("success", "Story updated successfully");
        } else {
            return redirect()->back()->with("error", "Failed to update story");
        }
    }

    public function update_status(Request $request)
    {
        $story = Story::findOrFail($request->id);
        $story->update($request->all());
        return response()->json([
            "success" => true,
        ]);
    }

    public function update_status_story(Request $request)
    {
        $story = Story::findOrFail($request->id);
        $story->update($request->all());
        return response()->json([
            "success" => true,
        ]);
    }

    public function update_feature(Request $request)
    {
        $story = Story::findOrFail($request->id);
        $story->update($request->all());
        return response()->json([
            "success" => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $result = Story::destroy($id);
        if ($result) {
            return redirect()->route("admin.story.index")->with("success", "Story deleted successfully");
        } else {
            return redirect()->back()->with("error", "Failed to delete story");
        }
    }


    public function index_chapter($story_id)
    {
        $story = Story::findOrFail($story_id);
        return view(
            "admin.pages.story.chap.index",
            compact("story")
        );
    }

    public function create_chapter(string $id)
    {
        $story = Story::findOrFail($id);
        if (!$story) {
            return redirect()->back()->with("error", "Story does not exist");
        }
        $title = "Add Chapter for Story - " . $story->title;
        $route = route('admin.story.store_chapter', $story->id);
        return view("admin.pages.story.chap.save", compact(
            "title",
            "route",
            "story"
        ));
    }

    public function store_chapter(Request $request, $id)
    {
        $story = Story::findOrFail($id);
        if (!$story) {
            return redirect()->back()->with("error", "Story does not exist");
        }
        $request->validate(
            [
                "title" => "required|string",
                "content" => "required|string",
            ]
        );
        $ketqua = transaction(function () use ($story, $request) {
            $slug = str_slug($request->title);
            $request->merge(["slug" => $slug]);
            $request->merge(["index" => 1 + $story->chapters()->max('index')]);
            $story->chapters()->create($request->all());
            return true;
        });

        if ($ketqua) {
            return redirect()->route("admin.story.index_chapter", $story->id)->with("success", "Chapter added successfully");
        } else {
            return redirect()->back()->with("error", "Failed to add chapter");
        }
    }

    public function edit_chapter($story_id, $id)
    {
        $story = Story::findOrFail($story_id);
        $chapter = $story->chapters()->findOrFail($id);
        $title = "Edit " . $chapter->title;
        $route = route('admin.story.update_chapter', [$story->id, $id]);
        if (!$chapter) {
            return redirect()->back()->with("error", "Story does not exist");
        }
        return view("admin.pages.story.chap.save", compact([
            'story',
            'title',
            'route',
            'chapter',
        ]));
    }

    public function update_chapter(Request $request, $story_id, $id)
    {
        $request->validate([
            'title' => "required|string|unique:chapters,title,$id,id",
            'content' => 'required|string',
        ]);
        $story = Story::findOrFail($story_id);
        $chapter = $story->chapters()->findOrFail($id);
        $ketqua = transaction(function () use ($chapter, $request) {
            $chapter->slug = str_slug($request->title);
            $chapter->update($request->all());
            return true;
        });
        if ($ketqua) {
            return redirect()->route("admin.story.index_chapter", $story->id)->with("success", "Chapter updated successfully");
        } else {
            return redirect()->back()->with("error", "Failed to update chapter");
        }
    }

    public function destroy_chapter(Request $request, $story_id, $id)
    {
        $story = Story::findOrFail($story_id);
        $chapter = $story->chapters()->findOrFail($id);
        $ketqua = transaction(function () use ($chapter, $request) {
            $chapter->delete();
            return true;
        });
        if ($ketqua) {
            return redirect()->route("admin.story.index_chapter", $story->id)->with("success", "Chapter deleted successfully");
        } else {
            return redirect()->back()->with("error", "Failed to delete chapter");
        }
    }

    public function update_chapter_order(Request $request, $story_id)
    {
        $ketqua = transaction(function () use ($request, $story_id) {
            $story = Story::findOrFail($story_id);
            $chapterIds = $request->chapterIds;
            foreach ($chapterIds as $index => $chapterId) {
                $chapter = $story->chapters()->find($chapterId);
                $chapter->update([
                    'index' => $index + 1,
                ]);
            }
            return true;
        });
        if ($ketqua) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
