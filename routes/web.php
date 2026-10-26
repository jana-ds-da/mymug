<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\DataTables\ProductDataTable;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SetLocale;

// home 

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/product', function () {
    return view('product');
})->name('product');

// signup, login ,logout

Route::get('/signup', [AuthController::class, 'showSignup'])
    ->name('signup');

Route::post('/signup', [AuthController::class, 'signup'])
    ->name('signup.store');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    return redirect()->route('home');
})->name('logout');

// products 

Route::get('/collection', [CollectionController::class, 'index'])
    ->name('collection');

Route::get('/product/{product}', [ProductController::class, 'show'])
    ->name('product.show');

Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');

Route::put('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy');

// cart

Route::get('/cart', [CartController::class, 'index'])
    ->middleware('auth')
    ->name('cart');

Route::post('/cart/add', [CartController::class, 'add'])
    ->middleware('auth')
    ->name('cart.add');

Route::patch('/cart/{cartItem}/increase', [CartController::class, 'increase'])
    ->middleware('auth')
    ->name('cart.increase');

Route::patch('/cart/{cartItem}/decrease', [CartController::class, 'decrease'])
    ->middleware('auth')
    ->name('cart.decrease');

Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])
    ->middleware('auth')
    ->name('cart.remove');

Route::delete('/cart/empty', [CartController::class, 'emptyCart'])
    ->name('cart.empty');

Route::post('/cart/empty', [CartController::class, 'emptyCart'])
    ->name('cart.empty');

// checkout 

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout');

// order receipt

Route::get('/receipt/{order}', [ReceiptController::class, 'show'])
    ->middleware('auth')
    ->name('receipt');

// dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'can:view dashboard'])
    ->name('dashboard');


// user management

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

Route::put('/users/{user}', [UserController::class, 'update'])
    ->middleware(['auth', 'can:manage users'])
    ->name('users.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->middleware(['auth', 'can:manage users'])
    ->name('users.destroy');

// role management

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

// department management

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

});

// order management
Route::middleware('auth')->group(function () {

    Route::get('/my-orders', [OrderController::class, 'myorders'])
        ->middleware('role:Customer')
        ->name('orders.my');

    Route::get('/admin/orders/{order}', [OrderController::class, 'show'])
        ->name('admin.orders.show');

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

});

// category management

Route::resource('category', CategoryController::class);

// language switching

Route::get('/language/{locale}', function ($locale) {

    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return redirect()->back();

})->name('language');

// authentication  

Route::get('/check-auth', function () {
    return Auth::check() ? 'LOGGED IN' : 'NOT LOGGED IN';
});
