<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class APIberitaController extends Controller
{

    public function showdata() {

        
    }


    public function create(Request $request) {

        $post = Post::create([
            'title' => $request->title,
            'news_content' => $request->news_content,
            'author' => $request->author,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }

    public function edit(Request $request, $id) {

        $data = Post::where('id', $id)->first();

        if (! $data) {
            return response([
                'message' => ['data tidak ada!']
            ], 404);
        }

        $data->update([
            'title' => $request->title,
            'news_content' => $request->news_content,
            'author' => $request->author,
        ]); 

        return response()->json([
            'status' => 'berhasil',
            'data' => $data
        ], 200);
    }
    

    public function delete($id) {

        $data = Post::where('id', $id)->first();

        if (! $data) {
            return response([
                'message' => ['Data tidak ada!']
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => "berhasil",
            'pesan' => "data berhasil dihapus"
        ], 200);
    }

    };


