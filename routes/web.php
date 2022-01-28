<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\dashboardController;

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

Route::get('/dashboard',[dashboardController::class, '__invoke'])->middleware(['auth'])->name('dashboard');

Route::get('/poll',[PollController::class, 'index'])->middleware(['auth'])->name('poll');


Route::post('/poll/add', [PollController::class, 'create'])->middleware(['auth'])->name('add_poll');

Route::post('/poll/edit', [PollController::class, 'edit'])->middleware(['auth'])->name('edit_poll');


Route::post('/poll/vote', [PollController::class, 'vote'])->middleware(['auth'])->name('add_answer');

Route::get('/poll/{id}/edit',[PollController::class, 'edit_view'])->middleware(['auth'])->name('edit.poll');

Route::get('/poll/{id}/delete',[PollController::class, 'delete'])->middleware(['auth'])->name('delete.poll');

Route::get('/poll/{id}',[PollController::class, 'answer'])->middleware(['auth'])->name('poll.answer');

require __DIR__.'/auth.php';
