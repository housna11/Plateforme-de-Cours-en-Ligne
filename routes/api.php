<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\InscriptionsController;
use  App\Http\Controllers\UsersController;
use  App\Http\Controllers\CoursController;
use  App\Http\Controllers\AuthController;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/users', [UsersController::class, 'index']);
Route::post('/users', [UsersController::class, 'store']);
Route::put('/users/{id}', [UsersController::class, 'update']);
Route::delete('/users/{id}', [UsersController::class, 'destroy']);

//Creer un cours
Route::post('/cours', [CoursController::class, 'store']);

//Cours prof
Route::get('/professeur/{id}/cours', [UsersController::class, 'professeur']);

//Cours d etudiant
Route::get('/etudiant/{id}/cours', [UsersController::class, 'etudiant']);

//Tous les cours
Route::get('/cours', [CoursController::class, 'index']);

//Detail de cours
Route::get('/cours/{id}', [CoursController::class, 'show']);

//Modifier
Route::put('/cours/{id}', [CoursController::class, 'update']);

//Supp
Route::delete('/cours/{id}', [CoursController::class, 'destroy']);

//Inscr etudiant 
Route::post('/inscriptions', [InscriptionsController::class, 'inscriptions']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');







