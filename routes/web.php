<?php

// use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\Banner;
use App\Http\Livewire\Admin\Calendar;
use App\Http\Livewire\Admin\Category as AdminCategory;
use App\Http\Livewire\Admin\Charts;
use App\Http\Livewire\Auth\AdminLogin;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\EditProfile;
use App\Http\Livewire\Admin\Forms;
use App\Http\Livewire\Admin\Pages;
use App\Http\Livewire\Admin\Product;
use App\Http\Livewire\Admin\Tables;
use App\Http\Livewire\Admin\Testi;
use App\Http\Livewire\Auth\UserLogin;
use App\Http\Livewire\Auth\UserRegister;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\User\About;
use App\Http\Livewire\User\ContectUs;
use App\Http\Livewire\User\Dashboard as UserDashboard;
use App\Http\Livewire\User\ProductCategory;
use App\Http\Livewire\User\ProductDetails;
use App\Http\Livewire\User\Services;
use App\Http\Livewire\User\ShopNow;
use App\Http\Livewire\User\ThanksForshopping;
// use App\Models\SiteBanner;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use PhpParser\Node\Expr\AssignOp\Concat;

// Route::get('/login', function () {
//     return redirect('/admin/login'); // Admin login page par redirect karein
// })->name('login'); // ⚡ Ye Laravel ke default login route ko handle karega



route::prefix('auth')->middleware('guest:admin')->group(function(){
    Route::get('/admin/login', AdminLogin::class)->name('admin.login');
});
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/edit-profile', EditProfile::class)->name('admin.editprofile');
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/charts', Charts::class)->name('admin.charts');
    Route::get('/products', Product::class)->name('admin.products');
    Route::get('/site-banner', Banner::class)->name('admin.site.banner');
    Route::get('/site-category', AdminCategory::class)->name('admin.site.category');
    Route::get('/site-testimonials', Testi::class)->name('admin.site.testimonials');
    Route::get('/forms', Forms::class)->name('admin.forms');
    Route::get('/tables', Tables::class)->name('admin.tables');    
    Route::get('/calendar', Calendar::class)->name('admin.calendar');
    Route::get('/pages', Pages::class)->name('admin.pages');

    
});



Route::get('/', UserDashboard::class)->name('user.dashboard')->middleware('auth:user');
Route::middleware('auth:user')->prefix('user')->group(function () {
    
    Route::get('/about', About::class)->name('user.about');
    Route::get('/contact-us', ContectUs::class)->name('user.cont');
    Route::get('/services', Services::class)->name('user.services');
    Route::get('/shop', ShopNow::class)->name('user.ShopNow');
    Route::get('/product-details/{id}', ProductDetails::class)->name('user.productdetails');
    Route::get('/product-category/{id}', ProductCategory::class)->name('user.productcategory');
    Route::get('/thanks-page/{orderid}', ThanksForshopping::class)->name('user.Thanks-page');
    Route::get('/checkout', Checkout::class)->name('user.checkout');
    // Route::get('/payment', Checkout::class)->name('create.payment.intent');
    Route::post('/create-charge', [Checkout::class, 'createCharge'])->name('create.charge');
});


route::prefix('auth')->middleware('guest:user')->group(function(){
    Route::get('/user/register', UserRegister::class)->name('user.register');
    Route::get('user/login', UserLogin::class)->name('user.login');
});

// Route::get('/', function () {
//     return view('welcome');
// });
