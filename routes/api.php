<?php

use App\Http\Controllers\ApiPostController;
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
