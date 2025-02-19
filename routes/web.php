<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ReviewController;







use Illuminate\Support\Facades\Route;

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


Route::get('/cart', [CartController::class, 'showCart'])->name('carts.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/passwords', [PasswordController::class, 'index'])->name('passwords.index');

Route::post('/reset-password', [PasswordController::class, 'reset'])->name('password.store');
Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route pour traiter le paiement ou l'action de checkout (POST)
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

// routes/web.php
Route::get('/checkout-thankyou', [CheckoutController::class, 'thankYou'])->name('checkout-thankyou.index');

Route::post('/checkout-hh', [CheckoutController::class, 'storecheckout'])->name('checkout.store');



Route::get('/product/{id}', [cartController::class, 'showProduct'])->name('product.details');
Route::get('/products', [ProductController::class, 'showProducts']);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('category.store');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('products/{id}/details', [ProductController::class, 'getProductDetails'])->name('product.getdetails');


Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
Route::post('users', [UsersController::class, 'store'])->name('users.store');
Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [UsersController::class, 'update'])->name('users.update');
Route::get('users/{user}/edit-role', [UsersController::class, 'editRole'])->name('users.editRole');
Route::put('users/{user}/update-role', [UsersController::class, 'updateRole'])->name('users.updateRole');
Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');


Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');
Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

Route::get('/pictures', [PictureController::class, 'index'])->name('pictures.index');
Route::get('pictures/create', [PictureController::class, 'create'])->name('pictures.create');
Route::post('pictures', [PictureController::class, 'store'])->name('pictures.store');
Route::get('pictures/{id}/edit', [PictureController::class, 'edit'])->name('pictures.edit');
Route::put('pictures/{id}', [PictureController::class, 'update'])->name('pictures.update');
Route::get('pictures/{id}', [PictureController::class, 'show'])->name('pictures.show');
Route::delete('/pictures/{id}', [PictureController::class, 'destroy'])->name('pictures.destroy');

Route::post('/update-password', [UsersController::class, 'updatePassword'])->name('update.password');


Route::get('/product-list', [ProductController::class, 'indexlist'])->name('product-list.index');
Route::get('/product-filter', [ProductController::class, 'filterProducts'])->name('product.filter');
Route::get('/product/quick-view/{id}', [ProductController::class, 'quickView']);


Route::get('/best-products', [HomeController::class, 'showBestProducts'])->name('home');

Route::get('/wishlist', [WishlistController::class, 'wishlistPage'])->name('wishlist');
Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index');

Route::middleware('auth')->group(function () {
    // Afficher la wishlist de l'utilisateur
    Route::get('wishlists', [WishlistController::class, 'index'])->name('wishlists.index');
    // Ajouter un produit à la wishlist
    Route::post('wishlists/add/{product}', [WishlistController::class, 'add'])->name('wishlists.add');
    // Supprimer un produit de la wishlist
    Route::delete('wishlists/{id}', [WishlistController::class, 'destroy'])->name('wishlists.destroy');
});

Route::patch('/admin/checkouts/{checkout}/status', [CheckoutController::class, 'updateStatus'])->name('admin.checkouts.updateStatus');



Route::put('/orders/{orderId}/update-status', [OrderController::class, 'updateOrderStatus'])->name('orders.updateStatus');

Route::get('/admin/checkouts/{id}/invoice', [CheckoutController::class, 'generateInvoice'])->name('admin.checkouts.generateInvoice');

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index')
    ->middleware('auth');

Route::get('admin/checkouts', [CheckoutController::class, 'index'])->name('admincheckouts.index');
Route::get('admin/checkouts/{id}/edit', [CheckoutController::class, 'edit'])->name('admin.checkouts.edit');
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Other admin routes

    Route::delete('checkouts/{checkout}', [CheckoutController::class, 'destroy'])->name('checkouts.destroy');
});
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::patch('/reviews/{id}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
Route::delete('/reviews/{id}/delete', [ReviewController::class, 'delete'])->name('reviews.delete');
Route::post('/reviews/store', [ProductController::class, 'storeReview'])->name('reviews.store');
Route::post('/reviews/{id}/toggle-approval', [ReviewController::class, 'toggleApproval'])->name('reviews.toggleApproval');

Route::post('/reviews/{id}/respond', [ReviewController::class, 'respond'])->name('reviews.respond');



/* Route::get('/', function () {
    return view('home.home');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
