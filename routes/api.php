<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// department routes
Route::get('/department', [DepartmentController::class, 'index']);
Route::post('/department', [DepartmentController::class, 'store']);
Route::get('/department/{department}', [DepartmentController::class, 'show']);
Route::put('/department/{department}', [DepartmentController::class, 'update']);
Route::delete('/department/{department}', [DepartmentController::class, 'destroy']);


//subject routes

Route::get('/subject', [SubjectController::class, 'index']);
Route::post('/subject', [SubjectController::class, 'store']);
Route::get('/subject/{subject}', [SubjectController::class, 'show']);
Route::put('/subject/{subject}', [SubjectController::class, 'update']);
Route::delete('/subject/{subject}', [SubjectController::class, 'destroy']);


//chapter routes

Route::get('/chapter', [ChapterController::class, 'index']);
Route::post('/chapter', [ChapterController::class, 'store']);
Route::get('/chapter/{chapter}', [ChapterController::class, 'show']);
Route::put('/chapter/{chapter}', [ChapterController::class, 'update']);
Route::delete('/chapter/{chapter}', [ChapterController::class, 'destroy']);


//question routes
Route::get('/question', [QuestionController::class, 'index']);
Route::get('/question/{question}', [QuestionController::class, 'show']);
Route::post('/question', [QuestionController::class, 'store']);
Route::put('/question/{question}', [QuestionController::class, 'update']);
Route::delete('/question/{question}', [QuestionController::class, 'destroy']);


//student routes
Route::post('/student/login', [StudentController::class, 'login']);
Route::post('/student/register', [StudentController::class, 'register']);
Route::post('/student/logout', [StudentController::class, 'logout']);
Route::post('/student/editProfile', [StudentController::class, 'editProfile']);
Route::post('/student/refresh', [StudentController::class, 'refresh']);


