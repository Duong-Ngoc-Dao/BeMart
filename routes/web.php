<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::match(['get', 'post'], '/category', [CategoryController::class, 'listCategory'])->name('list_Category');
//add new category
Route::match(['get', 'post'], '/category/add', [CategoryController::class, 'addCategory'])->name('add_Category');
//edit category
Route::match(['get', 'post'], '/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit_Category');
//delete category
Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete_Category');

Route::match(['get', 'post'], '/product', [ProductController::class, 'listProduct'])->name('list_Product');
Route::match(['get', 'post'], '/product/add', [ProductController::class, 'addProduct'])->name('add_Product');
//edit category
Route::match(['get', 'post'], '/product/edit/{id}', [ProductController::class, 'editProduct'])->name('edit_Product');
//delete category
Route::get('/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete_Product');
//post
Route::match(['get', 'post'], '/post', [PostController::class, 'listPost'])->name('list_Post');
Route::match(['get', 'post'], '/post/add', [PostController::class, 'addPost'])->name('add_Post');
//edit post
Route::match(['get', 'post'], '/post/edit/{id}', [PostController::class, 'editPost'])->name('edit_Post');
//delete post
Route::get('/post/delete/{id}', [PostController::class, 'deletePost'])->name('delete_Post');
