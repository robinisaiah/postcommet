<?php

namespace App;
use App\Comment;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'mime_type', 'file_path', 'file_name'];
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
