<?php

namespace App\Http\Controllers;

use App\ApiResponce;
use App\Http\Resources\PostResource;
use App\Models\Notes;
use App\UpdateNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    use ApiResponce, UpdateNote;
    public function index()
    {
        $notes = Notes::latest()->paginate(10);
        return view('notes.index',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validated = Validator::make($request->only(['title','content']),[
                'title' => 'required|max:250',
                'content' => 'required',
            ]);

            if ($validated->fails()) {
                return $this->apiResponce(['error' => true, 'message' => $validated->errors(), "status" => 422], 422);
            }
            $post = Notes::create([
                'title'=>$validated['title'],
                'content'=>$validated['content']
            ]);

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
    public function show(Notes $notes)
    {
        return view('notes.show',compact('notes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $notes)
    {
        return view('notes.edit',compact('notes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notes $notes)
    {
        $this->UpdateNote($request, $notes);

        return redirect()->route('posts.show', $notes)
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notes = Notes::find($id);

        if(!$notes)
        {
            return $this->apiResponce(['error'=>true,"message"=>"Note Not Found","status",404],404);
        }

        $notes->delete($id);

        return $this->apiResponce('Note Deleted Successfully',200,"Note Deleted");
    }
}
