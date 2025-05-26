<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\IllustrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\AdminController;

Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/users/{user}/follow', [UserFollowController::class, 'toggle'])->name('user.follow');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

Route::get('/dashboard', function () {
    return redirect()->route('profile.view', ['id' => Auth::id()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/genres/{id}', [ExploreController::class, 'showGenre'])->name('genre.show');

Route::get('/books/{id}', [ExploreController::class, 'showBook'])->name('book.show');

Route::get('/illustration/{id}', [IllustrationController::class, 'show'])->name('illustrations.show');

Route::get('/users/{id}', function ($id) {
    $user = \App\Models\User::findOrFail($id);
    return view('profile.show', compact('user'));
})->name('profile.view');

Route::get('/users/{id}', [ProfileController::class, 'show'])->name('profile.view');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::put('/profile/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::post('/illustration/{id}/like', [IllustrationController::class, 'like'])->name('illustrations.like');
Route::post('/illustration/{id}/comment', [IllustrationController::class, 'comment'])->name('illustrations.comment');

Route::post('/illustration/{id}/save', [IllustrationController::class, 'saveToCollection'])->name('collections.save');

Route::get('/explore/search', [BookController::class, 'search'])->name('books.search');

Route::get('/collections/{id}', [CollectionController::class, 'show'])->name('collections.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/upload/illustration', [IllustrationController::class, 'create'])->name('illustrations.create');
    Route::post('/upload/illustration', [IllustrationController::class, 'store'])->name('illustrations.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/upload/book', [BookController::class, 'create'])->name('books.create');
    Route::post('/upload/book', [BookController::class, 'store'])->name('books.store');
});

Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin.panel');

Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
Route::delete('/admin/illustration/{id}', [AdminController::class, 'deleteIllustration'])->name('admin.deleteIllustration');
Route::delete('/admin/book/{id}', [AdminController::class, 'deleteBook'])->name('admin.deleteBook');




// Rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';
