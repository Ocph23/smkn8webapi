<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MenuContentController;
use App\Http\Controllers\OauthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//auth
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});



///// view

Route::get('/client', [ClientController::class, "index"]);
Route::get('/client/menus', [ClientController::class, "menus"]);
Route::get('/client/carousel', [ClientController::class, "getCarousels"]);
Route::get('/client/maincontent/{id}', [ClientController::class, "getMainContent"]);
Route::post('/client/{id}/publish', [ClientController::class, "changepubish"])->name('client.blog.changepubish');
Route::get('/client/{id}/blog', [ClientController::class, "getBlog"]);
Route::get('/client/blogs', [ClientController::class, "getBlogs"]);
Route::get('/client/guru', [ClientController::class, "getGurus"]);
Route::get('/client/{id}/guru', [ClientController::class, "getGuru"]);
Route::post('/oauth/google', [OauthController::class, "withapi"]);

Route::get('/comment/blog/{blogid}', [CommentController::class, "getByBlogId"]);
Route::post('/comment', [CommentController::class, "post"]);
Route::put('/comment/{id}', [CommentController::class, "put"]);
Route::delete('/comment/{id}', [CommentController::class, "put"]);


