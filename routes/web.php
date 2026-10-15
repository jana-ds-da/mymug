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
use App\DataTables\ProductDataTable;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');


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

Route::get('/signup', [AuthController::class, 'showSignup'])
    ->name('signup');

Route::post('/signup', [AuthController::class, 'signup'])
    ->name('signup.store');  
    
Route::post('/products',[ProductController::class, 'store'])
     ->name('products.store');      

Route::get('/collection', [CollectionController::class, 'index'])
     ->name('collection');

Route::get('/product/{product}', [ProductController::class, 'show'])
    ->name('product.show');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy');   
    
Route::put('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update');    

 

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

Route::post('/logout', function (Request $request) {
    Auth::logout();

    return redirect()->route('home');
})->name('logout');

Route::get('/check-auth', function () {
    return Auth::check() ? 'LOGGED IN' : 'NOT LOGGED IN';
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'can:view dashboard'])
    ->name('dashboard');
    
Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth', 'can:view users'])
    ->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])
    ->middleware(['auth', 'can:manage users'])
    ->name('users.create');  
    
Route::post('/users', [UserController::class, 'store'])
    ->middleware(['auth', 'can:manage users'])
    ->name('users.store');  
    
Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->middleware(['auth', 'can:manage users'])
    ->name('users.edit'); 
    
Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->middleware(['auth', 'can:manage users'])
    ->name('users.destroy');
    
Route::put('/users/{user}', [UserController::class, 'update'])
    ->middleware(['auth', 'can:manage users'])
    ->name('users.update');   
    
Route::get('/roles', [RoleController::class, 'index'])
    ->middleware(['auth', 'can:view roles'])
    ->name('roles.index');

Route::get('/roles/create', [RoleController::class, 'create'])
    ->middleware(['auth', 'can:manage roles'])
    ->name('roles.create');

Route::post('/roles', [RoleController::class, 'store'])
    ->middleware(['auth', 'can:manage roles'])
    ->name('roles.store');

Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
    ->middleware(['auth', 'can:manage roles'])
    ->name('roles.edit');

Route::put('/roles/{role}', [RoleController::class, 'update'])
    ->middleware(['auth', 'can:manage roles'])
    ->name('roles.update');

Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
    ->middleware(['auth', 'can:manage roles'])
    ->name('roles.destroy');


Route::middleware('auth')->group(function () {

    Route::get('/departments', [DepartmentController::class, 'index'])
        ->middleware('permission:view departments')
        ->name('departments.index');

    Route::get('/departments/create', [DepartmentController::class, 'create'])
        ->middleware('permission:create departments')
        ->name('departments.create');

    Route::post('/departments', [DepartmentController::class, 'store'])
        ->middleware('permission:create departments')
        ->name('departments.store');

    Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])
        ->middleware('permission:edit departments')
        ->name('departments.edit');

    Route::put('/departments/{department}', [DepartmentController::class, 'update'])
        ->middleware('permission:edit departments')
        ->name('departments.update');

    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])
        ->middleware('permission:delete departments')
        ->name('departments.destroy');

    Route::get('/language/{locale}', function ($locale) {

    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return redirect()->back();

    })->name('language');  
    
  });  
    
    Route::middleware('auth')->group(function () {

    Route::get('/my-orders', [OrderController::class, 'myorders'])
        ->name('orders.my');

    Route::middleware('permission:view orders')->group(function () {

        Route::get('/all-orders', [OrderController::class, 'index'])
            ->name('orders.index');

    });

    Route::middleware('permission:update orders')->group(function () {

        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');

    });

    Route::middleware('permission:delete orders')->group(function () {

        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
            ->name('orders.destroy');

    });

    Route::resource('category', CategoryController::class);

});