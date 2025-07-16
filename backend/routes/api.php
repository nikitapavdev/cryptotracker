<?php

use App\Http\Controllers\Api\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*Route::middleware('auth:sanctum')->group(function () {



});*/

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/files/{file}/download', [FileController::class, 'download']);
Route::post('/files/upload-url', [FileController::class, 'getUploadUrl']);

Route::apiResource('files', FileController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

