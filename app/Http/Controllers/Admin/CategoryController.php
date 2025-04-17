<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Categories List";
        $categories = Category::all();
        return view("admin.pages.category.index", compact("title", "categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Category";
        $route = route('admin.category.store');
        return view("admin.pages.category.save", compact("title", "route"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:3|max:100|unique:categories,name,string",
            "status" => "required|boolean",
        ]);
        $slug = str_slug($request->name);
        $request->merge(["slug" => $slug]);
        Category::create($request->all());
        return redirect()->route("admin.category.index")->with("success", "Category added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route("admin.category.index")->with("error", "Category does not exist");
        }
        $title = "Edit Category: " . $category->name;
        $route = route('admin.category.update', $category->id);
        return view("admin.pages.category.save", compact("title", "category", "route"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|min:3|max:100|unique:categories,name,$id,id",
            "status" => "required|boolean",
        ]);
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route("admin.category.index")->with("error", "Category does not exist");
        }
        $category->slug = str_slug($request->name);
        $category->update($request->all());
        return redirect()->route("admin.category.index")->with("success", "Category updated successfully");
    }

    public function update_status(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Status updated successfully",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route("admin.category.index")->with("error", "Category does not exist");
        }
        $category->delete();
        return redirect()->route("admin.category.index")->with("success", "Category deleted successfully");
    }
}
