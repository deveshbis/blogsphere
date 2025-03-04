<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        $existingLike = Like::where('post_id', $post->id)->where('user_id', Auth::id())->first();

        if ($existingLike) {
            $existingLike->delete();
            $status = 'unliked'; 
        } else {
            Like::create([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
            ]);
            $status = 'liked'; 
        }
        return response()->json([
            'status' => $status,
            'likes_count' => $post->likes->count(),
        ]);
    }
}
