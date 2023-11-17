<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

#Login Register menggunakan library Laravel Sanctum
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


#Menggunakan Middleware
Route::middleware('auth:sanctum')->group(function () {

    //Get All News
    Route::get('/news', [NewsController::class, 'index']);

    //Membuat News
    Route::post('/news', [NewsController::class, 'store']);

    //Melihat Detail sebuah News
    Route::get('/news/{id}', [NewsController::class, 'show']);

    //Update News
    Route::put('/news/{id}', [NewsController::class, 'update']);

    //Menghapus News
    Route::delete('/news/{id}', [NewsController::class, 'destroy']);

    //Mencari News berdasarkan title
    Route::get('/news/search/{title}', [NewsController::class, 'search']);

    //Mencari News berdasarkan category sport
    Route::get('/news/category/sport', [NewsController::class, 'sport']);

    //Mencari News berdasarkan category finance
    Route::get('/news/category/finance', [NewsController::class, 'finance']);

    //Mencari News berdasarkan category automotive
    Route::get('/news/category/automotive', [NewsController::class, 'automotive']);
});
