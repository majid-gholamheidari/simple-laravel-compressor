<?php

use App\Http\Controllers\FileCompressorController;
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

Route::post('/upload-file', [FileCompressorController::class, 'fileCompressor']);
Route::post('/download-file', [FileCompressorController::class, 'downloadFile']);
