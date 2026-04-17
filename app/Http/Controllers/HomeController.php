<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags', 'likes', 'comments'])
            ->latest()
            ->paginate(10);

        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }
}
