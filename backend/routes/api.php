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

// Files upload and download
Route::get('/files/download-url/{id}/{s3_key}', [StorageController::class, 'download']);
Route::post('/files/upload-url', [StorageController::class, 'getUploadUrl']);

// Resource paths
Route::apiResource('files', FileController::class);
