<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Đăng nhập và xử lí đăng nhập

Route::get('admin/users/login',[LoginController::class,'index'])->name('login');

// Đăng xuất
Route::get('admin/users/logout',[LoginController::class,'logout']);


Route::post('admin/users/login/store',[LoginController::class,'store']);

Route::middleware(['auth'])->group(function(){

    Route::prefix('admin')->group(function(){


            Route::get('/',[MainController::class,'index'])->name('admin');

            Route::get('main',[MainController::class,'index']);

            // Menu

            Route::prefix('menus')->group(function(){
                Route::get('add',[MenuController::class, 'create']);
                Route::post('add', [MenuController::class, 'store']);
                Route::get('list',[MenuController::class, 'index']);
                Route::get('edit/{menu}', [MenuController::class, 'show']);
                Route::post('edit/{menu}', [MenuController::class, 'update']);
                Route::delete('destroy',[MenuController::class, 'destroy']);
               });

            // Product
            Route::prefix('products')->group(function(){
                Route::get('add', [ProductController::class, 'create']);
                Route::post('add', [ProductController::class, 'store']);



            });

            // Upload
            Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);
        });
});
// Menu

