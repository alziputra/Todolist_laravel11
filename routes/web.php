<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

// Route::get('/todo', function () {
//   return view('todo.app');
// });

// buat route baru untuk todo
Route::get('/todo',[TodoController::class, 'index'])->name('todo');

// store data digunakan untuk menyimpan data
Route::post('/todo',[TodoController::class, 'store'])->name('todo.post');
