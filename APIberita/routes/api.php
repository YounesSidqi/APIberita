<?php

use App\Http\Controllers\APIberitaController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/posts', [PostController::class, 'index'])->middleware('auth:sanctum');
Route::get('/posts/{id}', [PostController::class, 'show'])->middleware('auth:sanctum');
Route::get('/posts2/{id}', [PostController::class, 'show2']);

//Authentication 💀

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/profile', [AuthenticationController::class, 'profile'])->middleware('auth:sanctum');
Route::put('/editprofile/{user_id}', [AuthenticationController::class, 'editprofile'])->middleware('auth:sanctum');
Route::delete('/deleteprofile/{user_id}', [AuthenticationController::class, 'deleteprofile'])->middleware('auth:sanctum');
Route::get('/allusers', [AuthenticationController::class, 'allusers']);

Route::get('/showdata', [APIberitaController::class, 'showdata'])->middleware('auth:sanctum');
Route::post('/create', [APIberitaController::class, 'create']);
Route::patch('/edit/{id}', [APIberitaController::class, 'edit'])->middleware('auth:sanctum');
Route::delete('/delete/{id}', [APIberitaController::class, 'delete'])->middleware('auth:sanctum');
