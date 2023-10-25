<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
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

//Auth Routes
// Route::post('/inscription', [UserController::class, 'inscription']);
// Route::post('/connexion', [UserController::class, 'connexion']);

//Tasks Routes
Route::get('/tasks', [TasksController::class, 'index'])
    ->middleware('auth:sanctum');
Route::get('/tasks/{id}', [TasksController::class, 'show'])
    ->middleware('auth:sanctum');
Route::post('tasks', [TasksController::class, 'store'])
    ->middleware('auth:sanctum');
Route::put('/tasks/{id}', [TasksController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('/tasks/{id}', [TasksController::class, 'destroy'])
    ->middleware('auth:sanctum');
Route::get('/weekly-tasks', [TasksController::class, 'get_weekly_tasks'])
    ->middleware('auth:sanctum');


//Customers routes
Route::get('/customers', [CustomerController::class, 'index'])
    ->middleware('auth:sanctum');
Route::post('/customers', [CustomerController::class, 'store'])
    ->middleware('auth:sanctum');
Route::get('/customers/{customer_id}', [CustomerController::class, 'show'])
    ->middleware('auth:sanctum');
Route::put('/customers/{customer_id}', [CustomerController::class, 'update'])
    ->middleware('auth:sanctum');


//Auth Routes
Route::post('/login', [AuthController::class, 'login']);


//Dashboard Route
Route::get('dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth:sanctum');

//User Info Routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
