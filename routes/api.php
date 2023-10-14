<?php

use App\Http\Controllers\API\ProductController;
use App\Models\Product;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('product')->group(function(){
    // Lấy ra danh sách khách hàng
    Route::get('/', [ProductController::class, 'index']);

    // Lấy thông tin chi tiết
    Route::get('/{id}', [ProductController::class, 'show']);

    // Thêm thông tin khách hàng
    Route::post('/', [ProductController::class, 'store']);

    // Cập nhật thông tin khách hàng
    Route::put('/{id}', [ProductController::class, 'update']);

    // Xóa thông tin khách hàng
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
