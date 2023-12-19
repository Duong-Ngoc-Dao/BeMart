<?php

use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ProductController;
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

Route::prefix('post')->group(function(){
    // Lấy ra danh sách post
    Route::get('/', [ApiPostController::class, 'index']);

    // Lấy thông tin chi tiết
    Route::get('/{id}', [ApiPostController::class, 'show']);

    // Thêm thông tin post
    Route::post('/', [ApiPostController::class, 'store']);

    // Cập nhật thông tin post
    Route::put('/{id}', [ApiPostController::class, 'update']);

    // Xóa thông tin post
    Route::delete('/{id}', [ApiPostController::class, 'destroy']);
});
Route::prefix('category')->group(function(){
    // Lấy ra danh sách post
    Route::get('/', [ApiCategoryController::class, 'index']);

    // Lấy thông tin chi tiết
    Route::get('/{id}', [ApiCategoryController::class, 'show']);

    // Thêm thông tin post
    Route::post('/', [ApiCategoryController::class, 'store']);

    // Cập nhật thông tin post
    Route::put('/{id}', [ApiCategoryController::class, 'update']);

    // Xóa thông tin post
    Route::delete('/{id}', [ApiCategoryController::class, 'destroy']);
});
Route::prefix('product')->group(function(){
    // Lấy ra danh sách post
    Route::get('/', [ProductController::class, 'index']);

    // Lấy thông tin chi tiết
    Route::get('/{id}', [ProductController::class, 'show']);

    // Thêm thông tin post
    Route::post('/', [ProductController::class, 'store']);

    // Cập nhật thông tin post
    Route::put('/{id}', [ProductController::class, 'update']);

    // Xóa thông tin post
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});