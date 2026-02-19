<?php

namespace App;


use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Log;

trait UpdatePost
{
   use ApiResponce;
    public function updatePost(Request $request,$post)
    {
        try {

            Log::info("UpdatePost Trait Called with Post ID: " . $post);

            if ($post->user_id !== auth()->id()) {
                abort(403);
            }

            $post = Post::findOrFail($post['id']);

            if (!$post) {
                return $this->apiResponce(['error' => true, "message" => "Post Not Found", "status" => 404], 404, "Post Not Found");
            }

            $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'tags' => 'array',
                'tags.*' => 'exists:tags,id',
                'image' => 'nullable|image|max:4048'
            ]);

            $post->title = $validated['title'];
            $post->content = $validated['content'];
            $post->category_id = $validated['category_id'];

            if ($request->hasFile('image')) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image_path);
                }
                $path = $request->file('image')->store('post-images', 'public');
                $post->image_path = $path;
            }

            $post->save();


            if ($request->has('tags')) {
                $post->tags()->sync($request->tags);
            } else {
                $post->tags()->detach();
            }


            $post->save();

            // $post->update($validated);
            return $this->apiResponce(
                new PostResource($post),
                'Post edited successfully',
                201
            );

                // return $this->apiResponce(new PostResource($post), 201, 'updated');


        } catch (\Illuminate\Validation\ValidationException $e) {
        return $this->apiResponce([
            'error' => true,
            'message' => 'Validation failed',
            'errors' => $e->errors(),
            'status' => 422
        ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->apiResponce([
                'error' => true,
                'message' => 'Post not found',
                'status' => 404
            ], 404);

        } catch (\Exception $e) {
            Log::error("Post Update Error: " . $e->getMessage());
            return $this->apiResponce([
                'error' => true,
                'message' => 'An error occurred while updating the post',
                'status' => 500
            ], 500);
        }

    }
}
