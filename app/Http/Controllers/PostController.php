<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function listPost(Request $request)
    {
        $Posts = Post::all();

        if ($request->post() && $request->search_Post) {
            $Posts = DB::table('Post')
                ->where('content', 'like', '%' . $request->search_Post . '%')->get();
        }
        return view('postss.index', compact('Posts'));
    }
    // public function fontPost(){
    //     $Post = Post::all();
    //     $category = Category::all();
    //     return view('fontend.home',compact('Post','category'));
    // }
    public function addPost(PostRequest $request)
    {

        if ($request->isMethod('post')) { //kireerm tra phương thức nào gửi lên
            // dd($request);
            $params = $request->post(); //lấy dữ liệu từ request gửi lên 

            unset($params['_token']); //xóa token khi request gửi lên

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $request->image = uploadFile('image', $request->file('image'));
            }
            //Thêm dữ liệu vào db thông qua model
            $Post = new Post();
            $Post->content = $request->content;
            $Post->image = $request->image;

            $Post->save(); //lưu dữ liệu
            //tạo thông báo
            if ($Post->save()) {
                Session::flash('success', 'Add new Post success');
                return redirect()->route('list_Post');
            } else {
                Session::flash('error', 'Add new Post error');
            }
        }
        return view('postss.add');
    }

    public function editPost(Request $request, $id)
    {

        $detail = Post::find($id); //tìm theo id

        if ($request->isMethod('post')) {
            $params = $request->except('_token', 'image');

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                //Xóa ảnh cũ nếu update ảnh mới
                $deleteImage = Storage::delete('/public/' . $detail->image);
                if ($deleteImage) {
                    $request->image = uploadFile('image', $request->file('image'));
                    $params['image'] = $request->image;
                }
            } else {
                $params['image'] = $detail->image;
            }

            $update = Post::where('id', $id)->update($params);

            if ($update) {
                Session::flash('success', 'Edit new Post success');
                return redirect()->route('list_Post');
            } else {
                Session::flash('error', 'Edit new Post error');
            }
        }

        return view('postss.edit', compact('detail'));
    }

    public function deletePost($id)
    {
        // dd($id);
        if ($id) {
            $deleted = Post::where('id', $id)->delete();
            if ($deleted) {
                Session::flash('success', 'Delete Post success');
                return redirect()->route('list_Post');
            } else {
                Session::flash('error', 'Delete Post error');
            }
        }
        return;
    }
}
