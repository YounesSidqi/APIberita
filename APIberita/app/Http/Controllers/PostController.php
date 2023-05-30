<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\ShowResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $berita = Post::all();

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $berita
        // ]);
        
        return PostResource::collection($berita);
    }

    public function show($id) {
        $post = Post::with('writer')->findOrFail($id);

        // return response()->json([
        //         'status' => 'success',
        //         'data' => $post
        //     ]);

        return new ShowResource($post);
    }

    public function show2($id) {
        $post = Post::findOrFail($id);

        // return response()->json([
        //         'status' => 'success',
        //         'data' => $post
        //     ]);

        return new ShowResource($post);
    }
}
