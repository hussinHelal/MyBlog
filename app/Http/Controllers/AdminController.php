<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Notes;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {
        $postCount = Post::count();
        $noteCount = Notes::count();
        $userCount = User::count();
        $commentCount = Comment::count();

        return view('dashboard.index', compact('postCount', 'noteCount', 'userCount' , 'commentCount'));
    }

    public function showPosts()
    {
        $posts = Post::latest()->paginate(10);
        return view('dashboard.posts', compact('posts'));
    }

    public function showNotes()
    {
        $notes = Notes::latest()->paginate(10);
        return view('dashboard.notes', compact('notes'));
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

}
