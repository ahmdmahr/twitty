<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;





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



// Route::group(['prefix'=>'posts/','as'=>'posts.'],function(){

//   Route::get('/{post}', [PostController::class, 'show'])->name('show');

//   Route::group(['middleware'=>['auth']] , function(){
//     Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');

//     Route::put('/{post}', [PostController::class, 'update'])->name('update');

//     Route::post('', [PostController::class, 'store'])->name('store');

//     Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');

//    Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

//   });


// });


Route::get('/lang/{lang}', function ($lang) {

    // dd($lang);

    // change the lang for current page
    app()->setLocale($lang);

    // change it on every page by session
    session()->put('locale', $lang);

    return redirect()->route('dashboard');
})->name('lang');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// create all routes expect 3 in the array with auth middleware.
Route::resource('posts', PostController::class)->except(['index', 'create', 'show'])->middleware('auth');

// create another resource with show route only.
Route::resource('posts', PostController::class)->only(['show']);

Route::resource('posts.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users', UserController::class)->only(['show']);


Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware('auth');

Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('posts/{post}/like', [PostLikeController::class, 'like'])->middleware('auth')->name('posts.like');
Route::post('posts/{post}/unlike', [PostLikeController::class, 'unlike'])->middleware('auth')->name('posts.unlike');

Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');


Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::middleware(['auth', 'can:admin'])->prefix('/admin')->as('admin.')->group(function () {
    Route::get('', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts');
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});
