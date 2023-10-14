<?php

namespace App\Http\Controllers\API;
use App\Models\Product;
use App\Http\Resources\ProductResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $product = Product::create($request->all());

        // Trả về thông tin của khách hàng vừa thêm dưới dạng json
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $product = Product::find($id);
        if($product){
            return new ProductResource($product);
        } else{
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product = Product::find($id);

        if ($product) {
            // Cập nhật thông tin khách hàng
            $product->update($request->all());
            // Trả về dữ liệu thông tin khách hàng dưới dạng Json
            return new ProductResource($product);
        } else {
            // Nếu không có thì trả về lỗi 404
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);

        if ($product) {
            // Nếu có thì thực hiện việc xóa thông tin
            $product->delete();
            // Trả về dữ liệu thông tin khách hàng dưới dạng Json
            return response()->json(['message' => 'Xóa thông tin sản phẩm thành công'], 200);
        } else {
            // Nếu không có thì trả về lỗi 404
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }
    }
}
