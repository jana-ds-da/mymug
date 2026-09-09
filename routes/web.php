<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReceiptController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\DataTables\ProductsDataTable;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/about', function () {
    return view('about');
})->name('about');


//Route::get('/collection', function () {
  //  return view('collection');
//})->name('collection');


Route::get('/cart', [CartController::class, 'index'])
    ->middleware('auth')
    ->name('cart');


Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');


Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/product', function () {
    return view('product');
})->name('product');


Route::get('/signup', function () {
    return view('signup');
})->name('signup');



Route::post('/signup',[AuthController::class, 'signup'])
      ->name('signup.store');



      
Route::post('/products',[ProductController::class, 'store'])
     ->name('products.store');      


Route::get('/collection', [CollectionController::class, 'index'])
     ->name('collection');


Route::get('/product/{product}', [ProductController::class, 'show'])
    ->name('product.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy');   
    
Route::put('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update');    


Route::get('/collection', [CollectionController::class, 'filter'])
     ->name('collection');   


Route::post('/login',[AuthController::class, 'login'])
     ->name('login.store');


Route::post('/cart/add', [CartController::class, 'add'])
     ->middleware('auth')
     ->name('cart.add');     


Route::patch('/cart/{cartItem}/increase',[CartController::class, 'increase'])
      ->middleware('auth')
      ->name('cart.increase');
      
   
Route::patch('/cart/{cartItem}/decrease',[CartController::class, 'decrease'])
      ->middleware('auth')
      ->name('cart.decrease');
      
    
Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])
    ->middleware('auth')
    ->name('cart.remove');      

 

Route::post('/checkout', [CheckoutController::class, 'store'])
      ->name('checkout.store');  
      
      

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout');  
    
    

Route::get('/receipt/{order}', [ReceiptController::class, 'show'])
    ->middleware('auth')
    ->name('receipt');  
    
    
  

Route::get('/logout', function (Request $request) {
    Auth::logout();

  

    return redirect()->route('home');
})->name('logout');



Route::get('/check-auth', function () {
    return Auth::check() ? 'LOGGED IN' : 'NOT LOGGED IN';
});


//Route::get('/users/data', [UserController::class, 'data'])
   // ->middleware('auth')
    //->name('users.data');



Route::get('/products/data', function (ProductsDataTable $dataTable) {
    return $dataTable->getData();
})->name('products.data');   
