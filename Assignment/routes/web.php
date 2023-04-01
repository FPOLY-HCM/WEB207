<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ReplyDiscussionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
    $tags = Tag::all();

    return view('app', compact('tags'));
})->name('home');

Route::prefix('api')->name('api')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('register', RegisterController::class)->name('register');
        Route::post('login', LoginController::class)->name('login');
    });

    Route::resource('discussions', DiscussionController::class);
    Route::post('discussions/{discussion}/reply', ReplyDiscussionController::class)->name('discussions.reply');
    Route::resource('tags', TagController::class);
    Route::resource('users', UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');
});

Route::get('/{any}.html', function ($any) {
    if (!View::exists('template.' . $any)) {
        abort(404);
    }

    return view('template.' . $any);
})->where('any', '.*');
