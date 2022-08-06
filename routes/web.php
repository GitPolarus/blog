<?php

use App\Http\Controllers\admin\ArticleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
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


Route::get('/login', [AuthController::class, "index"])->name('login.display');

Route::post('/login', [AuthController::class, "login"])->name("login");
Route::middleware(['auth','admin'])->group(function(){
    
    /* 
    Start admin routes
    */
    Route::prefix('admin')->group(function(){

    Route::get('/', function () {
            return view('admin.home');
    })->name('admin.dashbord');
    // Start article routes
    Route::resource("articles", ArticleController::class)->names([
        'create'=>'articles.create',
        'index'=>'articles.list',
    ])->except(['show']);
    Route::get("articles/{article}/show", [ArticleController::class, 'show'] )->name("articles.show");
    Route::put("articles/{id}/publish", [ArticleController::class, "publish"])->name('articles.publish');
    Route::post("articles/search", [ArticleController::class, "search"])->name('articles.search');
    
    /* 
     End article routes
    */

    /* 
     Start Users routes
    */
        Route::resource("users", UserController::class)->names([
            'create'=>'users.create',
            'index'=>'users.list',
        ]);
        Route::get("users/{user}/show", [UserController::class, 'show'] )->name("users.show");
        Route::put("users/{id}/activate", [UserController::class, "publish"])->name('users.activate');
        Route::post("users/search", [UserController::class, "search"])->name('users.search');
    /* 
     End Users routes
    */

    });
    /* 
    end admin routes
    */
    
});

Route::get('/logout', [AuthController::class, "logout"]);