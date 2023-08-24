<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Auth::routes();

Route::get('/addstudents', [App\Http\Controllers\HomeController::class, 'addStudent']);
Route::post('/storestudent', [App\Http\Controllers\HomeController::class, 'storeStudent']);
Route::get('/loadStudentTable', [App\Http\Controllers\HomeController::class, 'loadStudentTable']);