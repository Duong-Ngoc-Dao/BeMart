<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function listProduct(Request $request)
    {
        // $products = Product::all();
        $products = Product::select('product.*','category.Name as Category')
        ->leftJoin('category','product.Category','=','category.id')
        ->get();
        if ($request->post() && $request->search_product) {
            // $products = DB::table('products')
            //     ->where('Product_Name', 'like', '%' . $request->search_product . '%')->get();
        }
        return view('product.index', compact('products'));
    }
    // public function fontProduct(){
    //     $product = Product::all();
    //     $category = Category::all();
    //     return view('fontend.home',compact('product','category'));
    // }
    public function addProduct(ProductRequest $request)
    {

        if ($request->isMethod('post')) { //kireerm tra phương thức nào gửi lên
            // dd($request);
            $params = $request->post(); //lấy dữ liệu từ request gửi lên 

            unset($params['_token']); //xóa token khi request gửi lên

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $request->image = uploadFile('image', $request->file('image'));
            }
            //Thêm dữ liệu vào db thông qua model
            $product = new Product();
            $product->Name = $request->Name;
            $product->Price = $request->Price;
            $product->image = $request->image;
            $product->Description = $request->Description;
            $product->Quantity = $request->Quantity;
            $product->Category = $request->Category;

            $product->save(); //lưu dữ liệu
            //tạo thông báo
            if ($product->save()) {
                Session::flash('success', 'Add new Category success');
                return redirect()->route('list_Product');
            } else {
                Session::flash('error', 'Add new Category error');
            }
        }
        return view('product.add');
    }

    public function editProduct(Request $request, $id)
    {

        $detail = Product::find($id); //tìm theo id

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

            $update = Product::where('id', $id)->update($params);

            if ($update) {
                Session::flash('success', 'Edit new Category success');
                return redirect()->route('list_Product');
            } else {
                Session::flash('error', 'Edit new Category error');
            }
        }

        return view('product.edit', compact('detail'));
    }

    public function deleteProduct($id)
    {
        // dd($id);
        if ($id) {
            $deleted = Product::where('id', $id)->delete();
            if ($deleted) {
                Session::flash('success', 'Delete Category success');
                return redirect()->route('list_Product');
            } else {
                Session::flash('error', 'Delete Category error');
            }
        }
        return;
    }
    public function index()
    {
        // $category = Product::all();
        // Trả về danh sách khách hàng dưới dạng JSON
        $product = Product::select('product.*','category.Name as Category')
        ->leftJoin('category','product.Category','=','category.id')
        ->get();
        // return ProductResource::collection($product);
        return response()->json($product, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Product::find($id);

        if($category){
            return new ProductResource($category);

        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Product::find($id);
        if($category){
           $category->update($request->all());
           return new ProductResource($category);

        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorys = Product::find($id);
        if($categorys){
            $categorys->delete();
            return response()->json(['message'=>'Xoa Danh Muc Thanh thanh cong'],200);
        }else{
            return response()->json(['message'=>'bai viet khong ton tai'],404);
        }
    }
}
