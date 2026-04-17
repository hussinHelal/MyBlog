<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Notes;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    public function index()
    {
        $postCount = Post::count();
        $userCount = User::count();
        $commentCount = Comment::count();

        return view('dashboard.index', compact('postCount',  'userCount' , 'commentCount'));
    }

    public function showPosts()
    {

//        $posts = Post::latest()->paginate(10);
        $posts = Post::with(['tags', 'category', 'user'])->latest()->paginate(10);
        $categories = Category::latest()->paginate(10);
        // $tags = $posts->pluck('tag')->flatten()->unique();
        $tags = Tag::all();
//         dd($posts, $categories, $tags);
        return view('dashboard.posts', compact('posts', 'categories', 'tags'));
    }


    public function showUsers()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.user', compact('users'));
    }

    public function showCategory()
    {
        $categories = Category::latest()->paginate(10);
        return view('dashboard.category', compact('categories'));
    }

    public function showComments()
    {
        $comments = Comment::latest()->paginate(10);
        return view('dashboard.comments', compact('comments'));
    }

    public function showTags()
    {
        $tags = Tag::latest()->paginate(10);
        return view('dashboard.tags', compact('tags'));
    }

    public function edit($id)
    {
        // not used (we use modal)
    }

}
