<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'homeindex'])->name('homeindex')->middleware(['cartcount']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::get('admin/dashboard', [HomeController::class, 'adminindex'])->name('adminindex')->middleware(['auth', 'admin']);
// ----------------------------------------------Products-------------------------------------------------------------

Route::get('/add_product', [AdminController::class, 'addproduct'])->name('addproduct')->middleware(['auth', 'admin']);
Route::post('/addproductsubmit', [AdminController::class, 'addproductsubmit'])->name('addproductsubmit')->middleware(['auth', 'admin']);
Route::get('/viewproduct', [AdminController::class, 'viewproduct'])->name('viewproduct')->middleware(['auth', 'admin']);
Route::post('/deleteproduct/{id}', [AdminController::class, 'deleteproduct'])->name('deleteproduct')->middleware(['auth', 'admin']);
Route::get('/editproduct/{id}', [AdminController::class, 'editproduct'])->name('editproduct')->middleware(['auth', 'admin']);
Route::post('/editproductsubmit/{id}', [AdminController::class, 'editproductsubmit'])->name('editproductsubmit')->middleware(['auth', 'admin']);
Route::get('/product/detail/{id}', [HomeController::class, 'productdetail'])->name('productdetali')->middleware(['cartcount']);



// -------------------------------------------------Category-----------------------------------------------------------------
Route::get('/categories', [AdminController::class, 'addcategory'])->name('addcategory')->middleware(['auth', 'admin']);
Route::post('/categoriessubmit', [AdminController::class, 'categoriessubmit'])->name('categoriessubmit')->middleware(['auth', 'admin']);
Route::get('/delete_category/{id}', [AdminController::class, 'deletecategory'])->name('deletecategory')->middleware(['auth', 'admin']);
Route::get('/edit_category/{id}', [AdminController::class, 'editcategory'])->name('editcategory')->middleware(['auth', 'admin']);
Route::post('/editcategorysubmit/{id}', [AdminController::class, 'editcategorysubmit'])->name('editcategorysubmit')->middleware(['auth', 'admin']);


// --------------------------------------------Carts------------------------------------------------------------------------------
Route::get('/carts', [CartController::class, 'carts'])->name('carts')->middleware(['auth', 'verified']);
Route::get('/addtocart/{id}', [CartController::class, 'addtocart'])->name('addtocart')->middleware(['auth', 'verified']);
Route::get('/deletecart/{id}', [CartController::class, 'deletecart'])->name('deletecart')->middleware(['auth', 'verified']);

// ---------------------------------------------------------------Orders------------------------------------------------------------
Route::post('/buynowsubmit',[CartController::class,'buynowsubmit'])->name('buynowsubmit')->middleware(['auth','verified']);
Route::get('/checkout/{product_id}', [CartController::class, 'showCheckout'])->name('checkout')->middleware(['cartcount']);

Route::get('/order', [CartController::class, 'order'])->name('order')->middleware(['auth', 'verified'])->middleware(['cartcount']);
ROute::get('order_list', [AdminController::class, 'adminorder'])->name('adminorder')->middleware(['auth', 'admin']);
Route::post('/confirmorder', [CartController::class, 'confirmorder'])->name('confirmorder')->middleware(['auth', 'verified']);
Route::get('/billing', [CartController::class, 'billingpage'])->name('billingpage')->middleware(['auth', 'verified'])->middleware(['cartcount']);
Route::get('/ontheway/{id}',[AdminController::class,'ontheway'])->name('ontheway')->middleware(['auth','admin']);
Route::get('/delivered/{id}',[AdminController::class,'delivered'])->name('delivered')->middleware(['auth','admin']);


Route::get('/payment',[HomeController::class,'payment'])->name('payment')->middleware(['auth','verified'])->middleware(['cartcount']);
Route::post('/paymentsubmit',[HomeController::class,'paymentsubmit'])->name('paymentsubmit')->middleware(['auth','verified'])->middleware(['cartcount']);
Route::post('/success/{orderId}',[HomeController::class,'paymentsuccess'])->name('paymentsuccess')->middleware(['auth','verified'])->middleware(['cartcount']);
