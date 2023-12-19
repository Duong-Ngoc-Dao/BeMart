<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        // Trả về danh sách khách hàng dưới dạng JSON
        return CategoryResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if($category){
            return new CategoryResource($category);

        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if($category){
           $category->update($request->all());
           return new CategoryResource($category);

        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorys = Category::find($id);
        if($categorys){
            $categorys->delete();
            return response()->json(['message'=>'Xoa Danh Muc Thanh thanh cong'],200);
        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }
}
