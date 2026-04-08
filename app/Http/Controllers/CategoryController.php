<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::all();
        return view('manage-courses', compact('categories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'catid' => 'required|unique:categories,catid',
            'category' => 'required',
            'image_url' => 'nullable|url'
        ]);

        Category::create([
            'catid' => $request->catid,
            'category' => $request->category,
            'image_url' => $request->image_url
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    // Delete category
    public function destroy($catid)
    {
        $category = Category::findOrFail($catid);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted!');
    }
}
