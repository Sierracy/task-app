<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TaskController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::get('/dashboard', [TaskController::class, 'create'])
                ->middleware(['auth'])
                ->name('dashboard');

Route::post('/dashboard', [TaskController::class, 'store']);

Route::delete('/dashboard/{task}', [TaskController::class, 'destroy'])
    ->name('task.destroy');
    
Route::get('/edit/{task}', [TaskController::class, 'showEditForm'])
    ->name('edit');

Route::post('/edit', [TaskController::class, 'updateTask'])
    ->name('updateTask');

require __DIR__.'/auth.php';
