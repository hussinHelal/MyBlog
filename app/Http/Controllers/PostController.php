<?php

namespace App\Http\Controllers;

use App\ApiResponce;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\UpdatePost;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
//use App\Models\Notes;

class PostController extends Controller
{
    use ApiResponce,UpdatePost;
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags', 'likes', 'comments'])
            ->latest()
            ->paginate(10);

        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        try{
//             $validated = $request->validate([
//                'title' => 'required|string|max:255',
//                'content' => 'required|string',
//                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:8048',
//                'tags' => 'nullable|array',
//                'tags.*' => 'exists:tags,id'
//            ]);
//
//            $imagePath = null;
//
//            if ($request->hasFile('image')) {
//                $imagePath = $request->file('image')->store('post-images', 'public');
//                $validated['image'] = $imagePath;
//            }
//
//           $post = Post::create([
//                'title'=>$validated['title'],
//                'content'=>$validated['content'],
//                'image_path' => $imagePath,
//            ]);
//
//            if (!empty($validated['tags'])) {
//            $post->tags()->attach($validated['tags']);
//              }
//            return $this->apiResponce(
//            new PostResource($post),
//            'Post created successfully',
//            201
//            );
//
//        } catch (\Illuminate\Validation\ValidationException $e) {
//        return response()->json([
//            'error' => true,
//            'message' => 'Validation failed',
//            'errors' => $e->errors()
//        ], 422);
//
//        } catch (\Exception $e) {
//            Log::error("Post Creation Error: " . $e->getMessage());
//            return response()->json([
//                'error' => true,
//                'message' => 'An error occurred while creating the post'
//            ], 500);
//        }
//    }
    public function store(Request $request)
    {
        if ($request->user()->cannot('create-post', Post::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:8048'
        ]);

//        $post = new Post();
//        $post->title = $validated['title'];
//        $post->content = $validated['content'];
//        $post->category_id = $validated['category_id'];
//        $post->user_id = auth()->id();
        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('post-images', 'public');
            $validated['image'] = $path;
        }

        $post = Post::create([
                'title'=>$validated['title'],
                'content'=>$validated['content'],
                'category_id'=>$validated['category_id'],
                'user_id'=> auth()->id(),
                'image_path' => $path,
        ]);
        $post->save();

//        if ($request->hasFile('image')) {
//            $path = $request->file('image')->store('post-images', 'public');
//            $validated['image'] = $path;
//        }


        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('posts.show', $post)->with('success', 'Post created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->incrementViews();
        $post->load(['comments.user', 'tags', 'likes']);
        return view('posts.show',compact('post'));
    }

    public function addLike(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id'
        ]);

        $post = Post::findOrFail($request->post_id);

        // Check if user already liked
        $existingLike = $post->likes()->where('user_id', auth()->id())->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $liked = false;
        } else {
            // Like
            $post->likes()->create([
                'user_id' => auth()->id()
            ]);
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $post->likes()->count()
        ]);
    }
    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function destroyComment(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        Log::info('omg',[$post]);
        if ($request->user()->cannot('update-post', $post)) {
            abort(403);
        }

        $this->UpdatePost($request, $post);

        return redirect()->route('showPosts', $post)
            ->with('success', 'Post updated successfully',$post);
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
            ->with(['user', 'tags', 'likes', 'comments'])
            ->latest()
            ->paginate(10);

        return view('posts.category', compact('category', 'posts'));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()
            ->with(['user', 'category', 'likes', 'comments'])
            ->latest()
            ->paginate(10);

        return view('posts.tag', compact('tag', 'posts'));
    }

    public function author(User $user)
    {
        $posts = $user->posts()
            ->with(['category', 'tags', 'likes', 'comments'])
            ->latest()
            ->paginate(10);

        return view('posts.author', compact('user', 'posts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Post $post, Request $request)
    {
        if ($request->user()->cannot('delete-post', Post::class)) {
            abort(403);
        }

        $post = Post::find($id);

        if(!$post)
        {
            $e = [''];
            return $this->apiResponce([
            'error' => true,
            'message' => 'Validation failed',
            'errors' => $e->errors(),
            'status' => 422
        ], 422);
        }

        $post->delete();

         return redirect()->back()
            ->with('success', 'Post deleted successfully');

    }
}
