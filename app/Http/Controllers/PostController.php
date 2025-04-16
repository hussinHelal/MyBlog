<?php

namespace App\Http\Controllers;

use App\ApiResponce;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\UpdatePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//use App\Models\Notes;

class PostController extends Controller
{
    use ApiResponce,UpdatePost;
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index',compact('posts'));
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
    public function store(Request $request)
    {
        try{
            $validated = Validator::make($request->only(['title','content','image_path']),[
                'title' => 'required|max:250',
                'content' => 'required',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:8048',
            ]);

            if ($validated->fails()) {
                return $this->apiResponce(['error' => true, 'message' => $validated->errors(), "status" => 422], 422);
            }
           $post = Post::create([
                'title'=>$validated['title'],
                'content'=>$validated['content']
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('post-images', 'public');
                $validated['image'] = $imagePath;
            }

            return $this->apiResponce(new PostResource($post), 201, 'created');

        } catch (\Exception $e) {

            return $this->apiResponce([
                'error' => true,
                'message' => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->UpdatePost($request, $post);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(!$post)
        {
            return $this->apiResponce(['error'=>true,"message"=>"Post Not Found","status",404],404);
        }

        $post->delete($id);

        return $this->apiResponce('Post Deleted Successfully',200,"Post Deleted");

    }
}
