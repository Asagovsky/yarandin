<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskStatusesController;
use Illuminate\Support\Facades\Auth;

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
    return redirect('/projects');
});

Route::get('/dashboard', function () {
    return redirect('/projects');
})->middleware(['auth'])->name('dashboard');

Route::resources([
    'projects' => ProjectController::class,
    'task-statuses' => TaskStatusesController::class,
    'projects/{project_id}/tasks' => TasksController::class
]);

require __DIR__.'/auth.php';



Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
