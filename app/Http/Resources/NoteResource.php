<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'         => $request->id ,
            'title'      => $this->title ,
            'content'    => $this->content ,
            'image_path' => $this->image_path
        ];
    }
}
