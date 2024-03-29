<?php

use App\Http\Controllers\UsersController; // UsersControllerを追加
use App\Http\Controllers\MatchUsersController;// MatchUsersControllerを追加
use App\Http\Controllers\PostsController;// PostsControllerを追加
use App\Http\Controllers\FriendsController;// FriendsControllerを追加
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('friend', [FriendsController::class, 'store'])->name('user.friend');
        Route::delete('unfriend', [FriendsController::class, 'destroy'])->name('user.unfriend');
        Route::get('friends', [UsersController::class, 'friends'])->name('users.friends');
        Route::get('friendRequests', [UsersController::class, 'friendRequests'])->name('users.friendRequests');
    });
    
    Route::resource('users', UsersController::class, ['only' => ['index']]);
    Route::resource('match_users', MatchUsersController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('myfriends', FriendsController::class, ['only' => ['index']]);
});
