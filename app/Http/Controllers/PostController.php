<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['comments.replies'])->get();
        return view('posts.postList', compact('posts'));
    }

    public function postsList()
    {
        $posts = Post::with(['comments.replies'])->get();
        return response()->json($posts, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'file' => 'required|mimes:jpeg,png,jpg,gif,mp4,mp3|max:20000',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $filename, 'public');
            $file_mime_type = $file->getClientMimeType();
        }else{
            $filename = null;
            $filePath = null;
            $file_mime_type = null;
        }

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'mime_type' =>  $file_mime_type,
            'file_name' => $filename,
            'file_path' =>  $filePath
        ]);

        return response()->json(['success' => true, 'result' => 'Successfully Uploaded!']);
    }
}
