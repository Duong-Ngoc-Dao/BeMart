<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function listCategory(Request $request){
        $categorys = Category::all();

        if($request -> post() && $request->search_category){
            $categorys = DB::table('category')
                ->where('Name','like','%' . $request->search_category . '%')->get();
        }
        return view('category.index', compact('categorys'));
    }
    

    public function addCategory(CategoryRequest $request){
        if($request->isMethod('post')){//kireerm tra phương thức nào gửi lên

            $params = $request->post();//lấy dữ liệu từ request gửi lên 

            unset($params['_token']);//xóa token khi request gửi lên

            //Thêm dữ liệu vào db thông qua model
            $category = new Category();
            $category->Name = $request->Name;

            $category->save();//lưu dữ liệu

            //tạo thông báo
            if($category->save()){
                Session::flash('success','Add new Category success');
                return redirect()->route('list_Category');
            }else {
                Session::flash('error','Add new Category error');
            }
        }
        return view('category.add');
    }

    public function editCategory(Request $request,$id){

        $detail = Category::find($id);//tìm theo id

        if($request->isMethod('post')){
            $update = Category::where('id', $id)->update($request->except('_token'));
            if($update){
                Session::flash('success','Edit new Category success');
                return redirect()->route('list_Category');
            }else{
                Session::flash('error','Edit new Category error');
            }
        }
        return view('category.edit',compact('detail'));
    }

    public function deleteCategory($id)
    {
        // dd($id);
        if($id){
            $deleted = Category::where('id', $id)->delete();
            if($deleted){
                Session::flash('success', 'Delete Category success');
                return redirect()->route('list_Category');
            }else {
                Session::flash('error', 'Delete Category error');
            }
        }
        return;
    }
}
