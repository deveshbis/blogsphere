<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'user_name' => $comment->user->name,
            'body' => $comment->body,
            'created_at' => $comment->created_at->diffForHumans(),
        ]);
    }

    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)->with('user')->get();
        return response()->json($comments);
    }

    public function getCommentCount($postId)
    {
        $post = Post::findOrFail($postId);
        $commentCount = $post->comments->count();
        return response()->json(['comment_count' => $commentCount]);
    }
}
