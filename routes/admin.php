<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Middleware\CheckAdminLogin;
use App\Http\Controllers\Admin\ProductController;
Route::prefix('admin')->as('admin.')->group(function(){
    Route::get('login',[LoginController::class,'index'])->middleware('is.login.admin')->name('login');
    Route::post('handle-login',[LoginController::class,'handleLogin'])->name('handle.login');
    Route::post('logout',[LoginController::class,'logout'])->name('logout');
});
Route::prefix('admin')->middleware(['check.admin.login'])->as('admin.')->group(function(){
    // tat ca cac routing deu bi middleware kiem soat
    //user
    Route::get('user',[UserController::class,'index'])->name('user');
    Route::get('add',[UserController::class,'add'])->name('user.add');
    Route::post('user/create',[UserController::class,'create'])->name('user.create');
    Route::get('user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
    Route::post('user/update/{id}',[UserController::class,'update'])->name('user.update');
    Route::delete('user/delete/{id}',[UserController::class,'delete'])->name('user.delete');
    //size
    Route::get('size',[SizeController::class,'index'])->name('size');
    Route::get('size/add',[SizeController::class,'add'])->name('size.add');
    Route::post('size/create',[SizeController::class,'create'])->name('size.create');
    Route::delete('size/delete/{id}',[SizeController::class,'delete'])->name('size.delete');
    Route::get('size/edit/{id}',[SizeController::class,'edit'])->name('size.edit');
    Route::post('size/update/{id}',[SizeController::class,'update'])->name('size.update');
    //dashboard
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    //order
    Route::get('order',[OrderController::class,'index'])->name('order');
    Route::post('order/no_accept/{extrs_code}',[OrderController::class,'no_accept'])->name('order.no_accept');
    Route::get('accept/{extrs_code}/{id}',[OrderController::class,'accept'])->name('order.accept');
    Route::get('view_order/{id}',[OrderController::class,'view'])->name('view');
    //product
    Route::get('product',[ProductController::class,'index'])->name('product');
    Route::get('addProduct',[ProductController::class,'add'])->name('product.add');
    Route::post('create',[ProductController::class,'create'])->name('product.create');
    Route::delete('delete/{id}',[ProductController::class,'delete'])->name('product.delete');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('update/{id}',[ProductController::class,'update'])->name('product.update');
    //color
    Route::get('color',[ColorController::class,'index'])->name('color');
    Route::get('color/add',[ColorController::class,'add'])->name('color.add');
    Route::get('color/edit/{id}',[ColorController::class,'edit'])->name('color.edit');
    Route::post('color/update/{id}',[ColorController::class,'update'])->name('color.update');
    Route::delete('color/delete/{id}',[ColorController::class,'delete'])->name('color.delete');
    Route::post('color/create',[ColorController::class,'create'])->name('color.create');
    //category
    Route::get('category',[CategoryController::class,'index'])->name('category');
    Route::delete('category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::get('category/add',[CategoryController::class,'add'])->name('category.add');
});