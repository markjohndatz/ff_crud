<?php

use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 //route of jquery


// Route::match(['post', 'get'], '/student', [App\Http\Controllers\Admin\StudentController::class, 'store']);
// Route::match(['post', 'get'], '/fetch-student', [App\Http\Controllers\Admin\StudentController::class, 'fetchstudent']);
// Route::match(['post', 'get'], '/edit-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'edit']);
// Route::match(['post', 'get'], '/update-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'update']);
// Route::match(['post', 'get'], '/delete-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'destroy']);




Route::post('/student', [App\Http\Controllers\Admin\StudentController::class, 'store']);
Route::get('/student', [App\Http\Controllers\Admin\StudentController::class, 'fetchstudent']);
Route::get('/student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'edit']);
Route::post('/update-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'update']);
Route::delete('/student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'destroy']);







Route::prefix('admin')->middleware(['auth' , 'isAdmin'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/books', [App\Http\Controllers\Admin\BooksController::class, 'index']);
    Route::get('/student', [App\Http\Controllers\Admin\StudentController::class, 'index']);
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index']);


});

