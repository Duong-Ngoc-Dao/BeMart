<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Lấy ra toàn bộ thông tin khách hàng
         $post = Post::all();
         // Trả về danh sách khách hàng dưới dạng JSON
         return PostResource::collection($post);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if($post){
            return new PostResource($post);

        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if($post){
           $post->update($request->all());
           return new PostResource($post);

        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posts = Post::find($id);
        if($posts){
            $posts->delete();
            return response()->json(['message'=>'Xoa thong tin bai viet thanh cong'],200);
        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }
}
