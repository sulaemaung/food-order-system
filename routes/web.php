<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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




//login//register
Route::middleware(['admin_auth'])->group(function(){
Route::redirect('/','loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
//Route::get('category/list',[CategoryController::class,'listPage'])->name('category#list');

});

Route::middleware(['auth'])->group(function () {
//dashboard
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
//admin
  Route::middleware(['admin_auth'])->group(function(){
    Route::prefix('category')->group(function () {
    //category
    Route::get('/list',[CategoryController::class,'listPage'])->name('category#list');
    Route::get('/create/page',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('create',[CategoryController::class,'create'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');
 });
   //admin account
   Route::prefix('admin')->group(function () {
    //password
    Route::get('password/changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

    //profile
    Route::get('details',[AdminController::class,'details'])->name('admin#details');
    Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
    Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
 });
   //admin list
   Route::get('/list',[AdminController::class,'list'])->name('admin#list');
   Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
   Route::get('changeRole',[AdminController::class,'changeRole'])->name('admin#changeRole');

   //user list
   Route::prefix('user')->group(function () {
    Route::get('list',[UserController::class,'list'])->name('user#list');
    Route::get('changeRole',[UserController::class,'changeRole'])->name('user#changeRole');
   });

   //product
    Route::prefix('product')->group(function (){
    Route::get('list',[ProductController::class,'list'])->name('product#list');
    Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
    Route::post('create',[ProductController::class,'create'])->name('product#create');
    Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
    Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
    Route::post('update',[ProductController::class,'update'])->name('product#update');
   });
   //order
   Route::prefix('order')->group(function (){
      Route::get('list',[OrderController::class,'list'])->name('order#list');
      Route::get('changeStatus',[OrderController::class,'changeStatus'])->name('order#changeStatus');
      Route::get('dbChangeStatus',[OrderController::class,'dbChangeStatus'])->name('order#dbChangeStatus');
      Route::get('listInfo',[OrderController::class,'listInfo'])->name('order#listInfo');
   });
    //contact
    Route::get('contactListPage',[AdminController::class,'contactListPage'])->name('admin#contactListPage');
   // Route::get('contactList',[AdminController::class,'contactList'])->name('admin#contactList');
  });
});
//user
  Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
   Route::get('/homePage',[UserController::class,'home'])->name('user#home');
   Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');

   Route::prefix('product')->group(function () {
    Route::get('details/{id}',[UserController::class,'productDetails'])->name('user#productDetails');

});

   Route::prefix('password')->group(function () {
       Route::get('changePassword',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
       Route::post('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');
   });

   Route::prefix('password')->group(function () {
    Route::get('changeAccount',[UserController::class,'changeAccountPage'])->name('user#changeAccountPage');
    Route::post('updateAccount/{id}',[UserController::class,'updateAccount'])->name('user#updateAccount');
   });

   //contact page

   Route::get('contact',[UserController::class,'contact'])->name('user#contact');
   Route::post('contactInfo',[UserController::class,'contactInfo'])->name('user#contactInfo');


   Route::prefix('cart')->group(function (){
    Route::get('cartList',[UserController::class,'cartList'])->name('user#cartList');
    Route::get('history',[UserController::class,'history'])->name('user#history');
   });
   Route::prefix('ajax')->group(function (){
     Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzalist');
     Route::get('addCart',[AjaxController::class,'addCart'])->name('ajax#addCart');
     Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
     Route::get('clearCart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
     Route::get('clearCurrent',[AjaxController::class,'clearCurrent'])->name('ajax#clearCurrent');
     Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
   });

   });





