<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;

class PostController extends Controller
{
    public static function routes()
    {
        Route::prefix('posts')->middleware('auth:api')->group(function () {
            Route::get('/', [self::class, 'index']);
            Route::get('{post}', [self::class, 'show']);
            Route::post('/', [self::class, 'store']);
            Route::put('{post}', [self::class, 'update']);
            Route::delete('{post}', [self::class, 'destroy']);
        });
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->get('title', ''),
            'content' => $request->get('content', ''),
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
        ], 201);
    }

    public function index()
    {
        $posts = Post::with('user')->get();
        return response()->json($posts, 200);
    }

    public function show($id)
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);


        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->update($request->only(['title', 'content']));

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post,
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
