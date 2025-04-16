<?php

namespace App;


use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

trait UpdatePost
{
   use ApiResponce;
    public function updatePost(Request $request,$post)
    {
        try {
            $post = Post::findOrFail($post['id']);

            if (!$post) {
                return $this->apiResponce(['error' => true, "message" => "Post Not Found", "status" => 404], 404, "Post Not Found");
            }
            $validation = Validator::make($request->only(['title', 'content', 'image_path']), [
                'title' => 'required|max:255',
                'content' => 'required',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:8048',
            ]);


            if ($request->hasFile('image_path')) {
                $path = $request->file('image')->store('images', 'public');
            }

            $post->update($validation->validated());


            if ($validation->fails()) {
                return $this->apiResponce(['error' => true, 'message' => $validation->errors(), "status" => 422], 422);
            }

            $post->update($validation->validated());


                return $this->apiResponce(new PostResource($post), 201, 'updated');


        } catch (\Exception $e) {
            \Log::error("Post Update Error: " . $e->getMessage()); // Log the error

            return $this->apiResponce([
                'error' => true,
                'message' => $e->getMessage(), // Show actual error message (for debugging)
                "status" => 500
            ], 500);
        }

    }
}
