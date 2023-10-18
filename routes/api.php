<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/createtodo', [PostController::class, 'createtodo']);
Route::put('/updatetodo', [PostController::class, 'updatetodo']);
Route::delete('/deletetodo', [PostController::class, 'deletetodo']);
Route::delete('/clearcomplete',[PostController::class, 'clearcomplete']);
Route::get('/alltodo', [PostController::class, 'alltodo']);
Route::get('/searchstatus/{status}', [PostController::class, 'searchstatus'])->where(['status'=>'[A-Za-z]+']);
