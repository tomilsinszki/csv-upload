<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/select-file', [UploadController::class, 'selectFile']);
Route::post('/upload-file', [UploadController::class, 'uploadFile'])->name('uploadFile');
Route::get('/process-file', [UploadController::class, 'processFile'])->name('processFile');
