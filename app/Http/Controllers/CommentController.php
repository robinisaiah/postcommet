<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = $post->comments()->create([
            'comment' => $request->comment,
        ]);

        return response()->json($comment, 201);
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $reply = $comment->replies()->create([
            'post_id' => $comment->post_id,
            'comment' => $request->comment,
            'parent_id' => $comment->id,
        ]);

        return response()->json($reply, 201);
    }
}
