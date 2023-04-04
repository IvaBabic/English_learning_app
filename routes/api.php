<?php

use App\Http\Controllers\LearnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


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

// Route::get('/learners', [LearnerController::class, 'index']);
// Route::post('/learners', [LearnerController::class, 'store']);
// Route::get('/learners/{id}', [LearnerController::class, 'show']);
// Route::put('/learners/{id}', [LearnerController::class, 'update']);

//public
 Route::post('/register', [AuthController::class, 'register']);
 Route::post('/login', [AuthController::class, 'login']);





//protected
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::resource('/learners', LearnerController::class);
//     Route::get('/learners/search/{name}', [LearnerController::class, 'search']);
//   Route::post('/logout', [AuthController::class, 'logout']);


// });

Route::group(['middleware' => ['auth:admin']], function () {
    Route::resource('/learners', LearnerController::class);
    Route::get('/learners/search/{name}', [LearnerController::class, 'search']);
    // Route::post('/logout', [AuthController::class, 'logout']);


});

Route::group(['middleware' => ['auth:learners']], function () {
    //Route::post('/logout', [AuthController::class, 'logout']);


});

Route::group(['middleware' => ['auth:learners', 'auth:admin']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
