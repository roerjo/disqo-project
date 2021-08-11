<?php

use App\Http\Controllers\API\V1;
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


Route::post('/register', V1\RegisterController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/notes', [V1\NoteController::class, 'index']);
    Route::post('/notes', [V1\NoteController::class, 'store']);
    Route::get('/notes/{note}', [V1\NoteController::class, 'show']);
    Route::put('/notes/{note}', [V1\NoteController::class, 'update']);
    Route::delete('/notes/{note}', [V1\NoteController::class, 'destroy']);
});
