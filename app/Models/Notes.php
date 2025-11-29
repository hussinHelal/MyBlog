<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Notes extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image_path'
    ];

    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
}
