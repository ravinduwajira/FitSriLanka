<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        $posts = Post::with('user', 'comments.user')->orderBy('created_at', 'desc')->get();
        return view('community', compact('posts','profileData'));
    }
    public function professionalpost()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        $posts = Post::with('user', 'comments.user')->orderBy('created_at', 'desc')->get();
        return view('Professional.community', compact('posts','profileData'));
    }

    public function adminpost()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        $posts = Post::with('user', 'comments.user')->orderBy('created_at', 'desc')->get();
        return view('Admin.community', compact('posts','profileData'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        // Generate a new filename with a timestamp to avoid collisions
        $photoName = date('YmdHi') . '_' . $request->file('image')->getClientOriginalName();
    
        // Move the uploaded photo to the desired directory
        $request->file('image')->move(public_path('upload/posts'), $photoName);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'image' => $photoName, 
        ]);

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function like(Post $post)
    {
        $post->increment('likes');
        return response()->json([
            'success' => true,
            'likes' => $post->likes,
            'dislikes' => $post->dislikes,
        ]);
    }
    
    public function dislike(Post $post)
    {
        $post->increment('dislikes');
        return response()->json([
            'success' => true,
            'likes' => $post->likes,
            'dislikes' => $post->dislikes,
        ]);
    }
    
    public function updateReaction(Request $request, Post $post, $reactionType)
    {
        $user = Auth::user();
    $post = Post::findOrFail($postId);

    if (!in_array($reactionType, ['like', 'dislike'])) {
        return response()->json(['success' => false, 'message' => 'Invalid reaction type.']);
    }

    $existingReaction = PostReaction::where('user_id', $user->id)->where('post_id', $post->id)->first();

    if ($existingReaction) {
        if ($existingReaction->reaction === $reactionType) {
            // Remove reaction if the same button is clicked again
            $existingReaction->delete();
        } else {
            // Update reaction if different button is clicked
            $existingReaction->reaction = $reactionType;
            $existingReaction->save();
        }
    } else {
        // Add new reaction
        PostReaction::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'reaction' => $reactionType
        ]);
    }

    // Recalculate counts
    $likes = PostReaction::where('post_id', $postId)->where('reaction', 'like')->count();
    $dislikes = PostReaction::where('post_id', $postId)->where('reaction', 'dislike')->count();

    return response()->json([
        'success' => true,
        'likes' => $likes,
        'dislikes' => $dislikes,
        'userReaction' => $existingReaction ? $existingReaction->reaction : null
    ]);
    }
    
    public function destroy(Post $post)
    {
        // Check if the user is authorized to delete the post
        if (Auth::user()->role === 'user' || Auth::user()->id === $post->user_id) {
            // Delete the post
            if ($post->image) {
                // Delete the image from storage if it exists
                Storage::delete('public/posts/' . $post->image);
            }
            $post->delete();
    
            return redirect()->route('community.index')->with('success', 'Post deleted successfully.');
        }
    
        return redirect()->route('community.index')->with('error', 'You are not authorized to delete this post.');
    }
    
    public function prodestroy(Post $post)
    {
        // Check if the user is authorized to delete the post
        if (Auth::user()->role === 'professional' || Auth::user()->id === $post->user_id) {
            // Delete the post
            if ($post->image) {
                // Delete the image from storage if it exists
                Storage::delete('public/posts/' . $post->image);
            }
            $post->delete();
    
            return redirect()->route('Professional.community')->with('success', 'Post deleted successfully.');
        }
    
        return redirect()->route('Professional.community')->with('error', 'You are not authorized to delete this post.');
    }

    public function admdestroy(Post $post)
    {
        // Check if the user is authorized to delete the post
        if (Auth::user()->role === 'Admin' || Auth::user()->id === $post->user_id) {
            // Delete the post
            if ($post->image) {
                // Delete the image from storage if it exists
                Storage::delete('public/posts/' . $post->image);
            }
            $post->delete();
    
            return redirect()->route('Admin.community')->with('success', 'Post deleted successfully.');
        }
    
        return redirect()->route('Admin.community')->with('error', 'You are not authorized to delete this post.');
    }
}

