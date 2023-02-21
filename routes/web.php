<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth2\RegisterController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\Adm\UserController;
use App\Http\Controllers\Adm\CategoryController;
use App\Http\Controllers\Adm\RoleController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::middleware('auth')->group(function (){
    Route::resource('products',ProductController::class)->except('index','show');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    Route::resource('comment',CommentController::class)->only('store','edit','update','destroy');
    Route::post('/products/{product}/rate',[ProductController::class,'rate'])->name('products.rate');
    Route::post('/products/{product}/liked',[ProductController::class,'liked'])->name('products.like');
    Route::post('/products/{product}/likebook',[ProductController::class,'bookLike'])->name('products.likee');
    Route::get('/books/favorites',[ProductController::class,'favorites'])->name('products.favorite');

    Route::prefix('adm')->as('adm.')->middleware('hasrole:admin')->group(function (){


        Route::get('/users',[UserController::class,'index'])->name('users.index');
        Route::get('/users/search',[UserController::class,'index'])->name('users.search');
        Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
        Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
        Route::put('/users/{user}/ban',[UserController::class,'ban'])->name('users.ban');
        Route::put('/users/{user}/unban',[UserController::class,'unban'])->name('users.unban');


        Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
        Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
        Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
        Route::delete('/categories/destroy/{category}',[CategoryController::class,'destroy'])->name('categories.destroy');


        Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
        Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
        Route::post('/roles/store',[RoleController::class,'store'])->name('roles.store');
        Route::delete('/roles/destroy/{role}',[RoleController::class,'destroy'])->name('roles.destroy');


        Route::get('/comments',[\App\Http\Controllers\adm\CommentController::class,'index'])->name('comments.index');
    });
    Route::prefix('adm')->as('adm.')->middleware('hasrole:admin,moderator')->group(function (){


        Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
        Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
        Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
        Route::delete('/categories/destroy/{category}',[CategoryController::class,'destroy'])->name('categories.destroy');


        Route::get('/comments',[\App\Http\Controllers\adm\CommentController::class,'index'])->name('comments.index');
        Route::delete('/comments/destroy/{comment}',[\App\Http\Controllers\adm\CommentController::class,'destroy'])->name('comments.destroy');

    });
});


Route::resource('products',ProductController::class)->only('index','show');
Route::get('/products/category/{category}',[ProductController::class,'productsByCategory'])->name('products.category');


Route::get('/register',[RegisterController::class,'create'])->name('register.form');
Route::post('/register',[RegisterController::class,'register'])->name('register');
Route::get('/login',[LoginController::class,'create'])->name('login.form');
Route::post('/login',[LoginController::class,'login'])->name('login');
/*Auth::routes();*/
