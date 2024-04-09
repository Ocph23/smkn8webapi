<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MainContentController;
use App\Http\Controllers\MenuContentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\MainContent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $userCount = User::count();
    return view('welcome', ["canRegister" => $userCount <= 0]);
});


Route::middleware(['auth', RoleMiddleware::class])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');


    Route::get('/admin/menu', [MenuContentController::class, 'index'])->name('admin.menu');
    Route::get('/admin/menu/create/{id}', [MenuContentController::class, 'create'])->name('admin.menu.create');
    Route::post('/admin/menu/post', [MenuContentController::class, 'post'])->name('admin.menu.post');
    Route::post('/admin/menu/put', [MenuContentController::class, 'put'])->name('admin.menu.put');
    Route::delete('/admin/menu/delete/{id}', [MenuContentController::class, 'delete'])->name('admin.menu.delete');
    Route::get('/admin/menu/{id}/edit', [MenuContentController::class, 'edit'])->name('admin.menu.edit');


    //maincontent
    Route::get('/admin/maincontent/create/{id}', [MainContentController::class, 'create'])->name('admin.maincontent.create');
    Route::post('/admin/maincontent/create/{id}', [MainContentController::class, 'post'])->name('admin.maincontent.post');


    //users
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/post', [UserController::class, 'post'])->name('admin.users.post');
    Route::get('/admin/users/changestatus/{id}', [UserController::class, 'changestatus'])->name('admin.users.changestatus');


    //blogs
    Route::get('/admin/blog', [BlogController::class, 'index'])->name('admin.blog');
    Route::get('/admin/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/admin/blog/post', [BlogController::class, 'post'])->name('admin.blog.post');
    Route::get('/admin/blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('/admin/blog/put', [BlogController::class, 'put'])->name('admin.blog.put');
    Route::delete('/admin/blog/{id}', [BlogController::class, 'delete'])->name('admin.blog.delete');

    //images
    Route::get('/admin/images', [GalleryController::class, 'index'])->name('admin.images');
    Route::get('/admin/images/upload', [GalleryController::class, 'create'])->name('admin.images.upload');
    Route::post('/admin/images', [GalleryController::class, 'store'])->name('admin.images.store');

    //guru
    Route::get('/admin/guru', [GuruController::class, 'index'])->name('admin.guru');
    Route::get('/admin/guru/create', [GuruController::class, 'create'])->name('admin.guru.create');
    Route::post('/admin/guru/post', [GuruController::class, 'post'])->name('admin.guru.post');
    Route::get('/admin/guru/{id}/edit', [GuruController::class, 'edit'])->name('admin.guru.edit');
    Route::post('/admin/guru/put', [GuruController::class, 'put'])->name('admin.guru.put');
    Route::get('/admin/guru/{id}/delete', [GuruController::class, 'delete'])->name('admin.guru.delete');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');

require __DIR__ . '/auth.php';
