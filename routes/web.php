<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('tasks', [TasksController::class, 'render']);
Route::post('tasks/store', [TasksController::class, 'store'])->name('task-store');
Route::get('tasks/edit/{id}', [TasksController::class, 'edit'])->name('task-edit');
Route::post('tasks/update/{id}', [TasksController::class, 'update'])->name('task-update');
Route::delete('tasks/{id}', [TasksController::class, 'destroy'])->name('task-delete');

