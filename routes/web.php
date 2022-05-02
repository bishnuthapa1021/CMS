<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CKEditorFileUploadController;
use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[FrontEndController::class,'index'])->name('index');

Route::prefix('/admin')->group(function(){

    //Admin Login
    Route::match(['get','post'], '/login',[AdminLoginController::class,'login'])->name('adminLogin');

    Route::group(['middleware'=>'admin'],function(){


    //Admin Dashboard
    Route::get('/dashboard',[AdminLoginController::class,'dashboard'])->name('adminDashboard');

    //Admin Profile
    Route::get('/profile',[AdminProfileController::class,'adminprofile'])->name('adminProfile');
    //Admin Profile Update
    Route::post('/profile/update/{id}',[AdminProfileController::class,'adminProfileUpdate'])->name('adminProfileUpdate');
    //Change Password
    Route::get('/profile/change_password',[AdminProfileController::class,'changePassword'])->name('changePassword');
    //update password
    Route::post('/profile/update_password/{id}',[AdminProfileController::class,'updatePassword'])->name('updatePassword');
     //Category
     Route::get('/category',[CategoryController::class,'index'])->name('category.index');
     Route::get('/category/add',[CategoryController::class,'add'])->name('category.add');
     Route::post('/category/store', [CategoryController::class,'store'])->name('category.store');
     Route::get('/table/category',[CategoryController::class,'datatable'])->name('table.category');
     Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
     Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
     Route::get('/delete-category/{id}',[CategoryController::class,'delete'])->name('category.delete');

     //Tag
     Route::get('/tag',[TagController::class,'index'])->name('tag.index');
     Route::get('/tag/add',[TagController::class,'add'])->name('tag.add');
     Route::post('/tag/store', [TagController::class,'store'])->name('tag.store');
     Route::get('/table/tag',[TagController::class,'datatable'])->name('table.tag');
     Route::get('/tag/edit/{id}',[TagController::class,'edit'])->name('tag.edit');
     Route::post('/tag/update/{id}',[TagController::class,'update'])->name('tag.update');
     Route::get('/delete-tag/{id}',[TagController::class,'delete'])->name('tag.delete');

     //Post
     Route::get('/post',[PostController::class,'index'])->name('post.index');
     Route::get('/post/add',[PostController::class,'add'])->name('post.add');
     Route::post('/post/store',[PostController::class,'store'])->name('post.store');
     Route::get('/table/post',[PostController::class,'datatable'])->name('table.post');
     Route::get('post/edit/{id}',[PostController::class,'edit'])->name('post.edit');
     Route::post('post/update/{id}',[PostController::class,'update'])->name('post.update');
     Route::get('post/show/{id}',[PostController::class,'show'])->name('post.show');
     Route::get('/delete-post/{id}',[PostController::class,'delete'])->name('post.delete');

     Route::post('ckeditor', [CKEditorFileUploadController::class,'store'])->name('ckeditor.upload');

});

//Admin Logout
Route::get('/logout',[AdminLoginController::class,'logout'])->name('adminLogout');
});
