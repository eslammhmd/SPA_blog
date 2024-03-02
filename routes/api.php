<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RelatedPostsController;
use Illuminate\Session\Middleware\AuthenticateSession;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login' , [AuthenticatedSessionController::class,'store']);
Route::post('/logout' , [AuthenticatedSessionController::class,'destroy']);



Route::post('/categories/create' , [CategoryController::class,'store']);
Route::get('/categories' , [CategoryController::class,'index']);
Route::get('/categories/{category}' , [CategoryController::class,'show']);
Route::put('/categories/{category}' , [CategoryController::class,'update']);
Route::delete('/categories/{category}' , [CategoryController::class,'destroy']);


// posts
Route::post('/posts' , [PostController::class,'store']);
// get all posts
Route::get('/chart_data' , [CategoryController::class,'getData']);


// show product by slug
Route::get('/posts/{post:slug}' , [PostController::class,'show']);


//get posts to Blog page
Route::get('/blog-posts' , [BlogController::class,'index']);

// filter category
Route::get('posts' , [PostController::class,'index']);

// relatedPosts
Route::get('/related-posts/{post:slug}',[RelatedPostsController::class, 'index']);


// send email => invoke method
Route::post('contact' , ContactController::class);
