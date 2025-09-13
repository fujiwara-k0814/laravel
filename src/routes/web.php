<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;


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

//お問い合わせフォーム
Route::get('/', [ContactController::class, 'index']);
Route::post('/', [ContactController::class, 'edit']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);


//管理画面
Route::middleware('auth')->group(function(){
    Route::get('/admin', [AdminController::class, 'index']);
});
Route::get('/admin/search', [AdminController::class, 'search']);
Route::delete('/admin/delete', [AdminController::class, 'destroy']);


//エクスポート
Route::get('/admin/export', [ExportController::class, 'export']);
