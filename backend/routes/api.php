<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StorageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentification
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth:sanctum']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Files upload and download
Route::get('/files/download-url/{id}/{s3_key}', [StorageController::class, 'GetDownloadUrl']);
Route::get('/files/upload-url', [StorageController::class, 'getUploadUrl']);

// Resource paths
Route::apiResource('files', FileController::class);


// FileGuard
Route::post('files/callback', [FileController::class, 'fileGuardCallBack'])->name('fileGuard.callback');
