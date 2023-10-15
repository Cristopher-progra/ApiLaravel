<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;


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
Route::delete('/estudiante/delete/{id}', [EstudianteController::class, 'deleteStudent']);
Route::get('/estudiante/find/{id}', [EstudianteController::class, 'findStudent']);
Route::put('/estudiante/update/{id}', [EstudianteController::class, 'updateStudent']);
Route::post('/estudiante/store', [EstudianteController::class, 'storeStudent']);
Route::get('/estudiante/select', [EstudianteController::class, 'selectStudent']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
