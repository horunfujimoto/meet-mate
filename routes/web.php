<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; // UsersControllerを追加
use App\Http\Controllers\MatchUsersController;// MatchUsersControllerを追加
use App\Http\Controllers\PostsController;// PostsControllerを追加
use App\Http\Controllers\FriendsController;// FriendsControllerを追加
use App\Http\Controllers\FavoritesController;// FavoritesControllerを追加
use App\Http\Controllers\CommentsController;// CommentsControllerを追加

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

Route::get('/', function () {return view('welcome');});

Route::get('/dashboard', [PostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
   
    Route::resource('users', UsersController::class, ['only' => ['index']]);
    Route::resource('match_users', MatchUsersController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('myfriends', FriendsController::class, ['only' => ['index']]);
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('friend', [FriendsController::class, 'store'])->name('user.friend');
        Route::delete('unfriend', [FriendsController::class, 'destroy'])->name('user.unfriend');
        Route::get('friends', [UsersController::class, 'friends'])->name('users.friends');
        Route::get('friendRequests', [UsersController::class, 'friendRequests'])->name('users.friendRequests');
    });
    
    Route::group(['prefix' => 'posts/{id}'], function () {
        Route::post('favorite', [FavoritesController::class, 'store'])->name('post.favorite');
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('post.unfavorite');
        Route::post('/', [CommentsController::class, 'store'])->name('comments.store');
        Route::delete('/', [CommentsController::class, 'destroy'])->name('comments.destroy');
    }); 
    
});
