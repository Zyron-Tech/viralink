<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/soon', function () {
    return view('soon');
});

Route::get('/donate', function () {
    return view('donate');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\TweetController;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\TrendingController;

Route::get('/trending', [TrendingController::class, 'index']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TweetController::class, 'index'])->name('dashboard');
    Route::post('/generate', [TweetController::class, 'generate'])->name('generate');
    Route::get('/history', [TweetController::class, 'history'])->name('history');
    Route::delete('/history/clear', [TweetController::class, 'clearHistory'])->name('history.clear');

});


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');


use App\Http\Controllers\HashtagController;

Route::get('/hashtags', [HashtagController::class, 'showForm'])->name('hashtags.form');
Route::post('/hashtags', [HashtagController::class, 'generate'])->name('hashtags.generate');

Route::post('/followed', function () {
    session(['has_followed' => true]);
    return response()->json(['unlocked' => true]);
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
});

use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});



require __DIR__.'/auth.php';
