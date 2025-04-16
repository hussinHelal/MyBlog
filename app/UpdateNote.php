<?php

namespace App;

use App\Http\Resources\PostResource;
use App\Models\Notes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

trait UpdateNote
{
    use ApiResponce;

    public function updateNote(Request $request, $note)
    {
        try {
            $note = Notes::findOrFail($note['id']);

            if (!$note) {
                return $this->apiResponce(['error' => true, "message" => "Note Not Found", "status" => 404], 404, "Post Not Found");
            }
            $validation = Validator::make($request->only(['title', 'content']), [
                'title' => 'required|max:255',
                'content' => 'required',
            ]);

            $note->update($validation->validated());


            if ($validation->fails()) {
                return $this->apiResponce(['error' => true, 'message' => $validation->errors(), "status" => 422], 422);
            }

            $note->update($validation->validated());


                return $this->apiResponce(new PostResource($note), 201, 'updated');


        } catch (\Exception $e) {
            \Log::error("Note Update Error: " . $e->getMessage()); // Log the error

            return $this->apiResponce([
                'error' => true,
                'message' => $e->getMessage(), // Show actual error message (for debugging)
                "status" => 500
            ], 500);
        }
    }
}
