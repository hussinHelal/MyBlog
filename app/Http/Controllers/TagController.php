<?php

namespace App\Http\Controllers;

use App\ApiResponce;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    use ApiResponce;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags ,200);
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
        try {
             Log::info('creating a tag');
            $validate = $request->validate([
                'name' => 'required|string|max:16'
            ]);

            $tag = Tag::create([
                'name' => $validate['name']
            ]);

            Log::info('tag created');
            return $this->apiResponce([
                'message' => 'Tag Created ',
                'data' => $tag ,
                'status' => 201
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
            'error' => true,
            'message' => 'Validation failed',
            'errors' => $e->errors()
            ], 422);

            } catch (\Exception $e) {
                Log::error("Tag Creation Error: " . $e->getMessage());
                return response()->json([
                    'error' => true,
                    'message' => 'An error occurred while creating the tag'
                ], 500);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        try {

        $tagId = Tag::find($tag->id);

        $validate = $request->validate(['name'=>'required| string| max:15']);

        if(!$tagId)
        {
            return $this->apiResponce([
                'error' => true,
                'message' => 'Tag not found',
                'status' => 404
            ], 404);
        }

        $tag->update($validate);

            return $this->apiResponce([
                'message' => 'Tag Updated',
                'data' => $tag,
                'status' => 201
            ], 201);

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
                    'message' => 'Tag not found',
                    'status' => 404
                ], 404);

            } catch (\Exception $e) {
                Log::error("Tag Update Error: " . $e->getMessage());
                return $this->apiResponce([
                    'error' => true,
                    'message' => 'An error occurred while updating the tag',
                    'status' => 500
                ], 500);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try{

            $tag = Tag::find($tag->id);

            if(!$tag)
            {
                return $this->apiResponce([
                    'error' => true,
                    'message' => 'Tag not found',
                    'status' => 404
                ], 404);
            }

            $tag->delete();

            return redirect()->back();

        } catch (\Exception $e) {
            Log::error("Tag Delete Error: " . $e->getMessage());
            return $this->apiResponce([
                'error' => true,
                'message' => 'An error occurred while deleting the tag',
                'status' => 500
            ], 500);
        }
    }
}
