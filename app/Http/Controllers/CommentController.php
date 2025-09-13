<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
{
    $request->validate([
        'body' => 'required|string|max:500',
    ]);

    try {
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        $comment->load('user'); // Load the user relationship for JSON response

        return response()->json([
            'success' => true,
            'comment' => $comment,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to add comment.',
        ], 500);
    }
}

}

