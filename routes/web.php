<?php

use App\Http\Controllers\cartcontroller;
use App\Http\Controllers\categoriescontroller;
use App\Http\Controllers\checkoutcontroller;
use App\Http\Controllers\indexcontroller;
use App\Http\Controllers\orderscontroller;
use App\Http\Controllers\userscontroller;
use App\Http\Controllers\productscontroller;
use Illuminate\Support\Facades\Route;
use App\Models\product;
use App\Models\category;
use App\Models\user;
use App\Models\order;
use App\Models\cart;
use App\Models\banner;
use Illuminate\Support\Facades\Auth;

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


$products=product::paginate(5);
$categories=category::get();


Route::resource('/products',productscontroller::class);
Route::resource('/categories',categoriescontroller::class);
// Route::view('/','index',['products'=>$products,'cart'=>cart::where('user_id',optional(Auth::id())->id)->get(),'categories'=>$categories]);
Route::get('/',[indexcontroller::class,'index'])->name('home');
Route::get('/search',[productscontroller::class,'search'])->name('search');

Route::middleware(['auth','isactive'])->group(function () {
    $products=product::paginate(5);
    $categories=category::get();
    Route::get('/profile',[userscontroller::class,'retrieveprofile'])->name('user.profile');
    Route::POST('/profile/update',[userscontroller::class,'updateprofile'])->name('user.updateprofile');
    Route::PATCH('/cart/add/{id}',[cartcontroller::class,'addmoretocart'])->name('cart.addmore');
    Route::PATCh('/cart/less/{id}',[cartcontroller::class,'takefromcart'])->name('cart.lessfromcart');
    Route::PATCH('profile/updateimage',[userscontroller::class,'updateimage'])->name('profile.update-image');
    Route::resource('/cart',cartcontroller::class);
    Route::resource('/orders',orderscontroller::class);
    Route::get('/checkout',[checkoutcontroller::class,'showdetails'])->name('user.checkout');
});

//Admin Pages
Route::middleware(['auth','isadmin','isactive'])->group(function () {
    $products=product::paginate(5);
    $categories=category::get();
    Route::view('/admin/products','admin-products',compact('products','categories'))->name('admin.products');
    Route::view('/admin/categories','admin-categories',['categories'=>category::paginate(5)])->name('admin.categories');
    Route::view('/admin/orders','admin-orders',['orders'=>order::paginate(5)])->name('admin.orders');
    Route::view('/admin','admin-dashboard',['orders'=>order::orderBy('id', 'DESC')->paginate(3),'orders_count'=>order::get()->count(),'users'=>user::get()->count(),'products'=>product::get()->count(),'banner'=>banner::get()->last()])->name('admin.dashboard');
    Route::resource('/admin/users',userscontroller::class);
    Route::POST('/setbanner',[indexcontroller::class,'setbanner'])->name('setbanner');
});
require __DIR__.'/auth.php';