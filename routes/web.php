<?php

use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

 Route::group([
    'middleware' => \App\Http\Middleware\IdentifyTenant::class,
    'as'         => 'tenant:',
], function () {





});
Route::middleware('tenant')->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/landing', function () {
    return Inertia::render('Landing');
})->name('landing');
Route::middleware(['auth:sanctum', 'verified'])->get('/cart', function () {
    return Inertia::render('Cart');
})->name('cart');

//
//Route::middleware(['auth:sanctum', 'verified'])->get('/products', function () {
//    return Inertia::render('Products');
//})->name('products');

Route::middleware(['auth:sanctum', 'verified'])->get('/products', [ProductController::class, 'index'])->name('products.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');



