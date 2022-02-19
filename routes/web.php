<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function() {
    return view('contact');
})->name('contact');

Route::post('/contact/detail', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Dashboard
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth']], function () {

    // Dashboard Home
	Route::get('/', function () {
        return view('dashboard');
    })->name('home');

    // Customers
    Route::get('/customers', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts');
    Route::post('/customers/create', [App\Http\Controllers\ContactController::class, 'createAccount'])->name('account.create');
    Route::get('/customers/view/{email}', [App\Http\Controllers\ContactController::class, 'view'])->name('account.view');
});

require __DIR__.'/auth.php';
