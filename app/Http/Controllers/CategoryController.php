<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cat = Category::latest()->get();
        return view('categories.index', compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Storing new category');
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $cat = Category::find($category->id);
        return view('categories.show', compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        Log::info('Updating category');
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
       $category->save();
        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
